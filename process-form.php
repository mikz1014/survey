<?php

$name = $_POST["name"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$question1 = $_POST["question1"];
$question2 = $_POST["question2"];
$question3 = $_POST["question3"];
$question4 = $_POST["question4"];
$question5 = $_POST["question5"];

$host = "localhost";
$dbname = "surveydb";
$username = "root";
$password = "";

$conn = mysqli_connect(
   hostname: $host, 
   database: $dbname, 
   password: $password,
   username: $username);

if(mysqli_connect_errno()){
    die("Connection error: ". mysqli_connect_error());
}

$sql = "INSERT INTO questionare (name, age, gender, question1, question2, question3, question4, question5) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init ($conn);

if ( !mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sissssss", $name, $age, $gender, $question1, $question2, $question3, $question4, $question5);

mysqli_stmt_execute($stmt);

$sql_fetch = "SELECT question1, question2, question3, question4, question5 FROM questionare";
$result = mysqli_query($conn, $sql_fetch);

// Ensure query execution was successful
if (!$result) {
    die("Error executing query: " . mysqli_error($conn));
}

// Initialize counts
$counts = [
    "question1" => [0, 0],
    "question2" => [0, 0],
    "question3" => [0, 0],
    "question4" => [0, 0],
    "question5" => [0, 0],
];

$total_always = 0;
$total_never = 0;

// Questions list
$questions = [
    "question1" => "How often do you create strong, unique passwords for your online accounts?",
    "question2" => "How often do you share your passwords with others?",
    "question3" => "How often do you recognize and avoid phishing emails or messages?",
    "question4" => "How often do you update your devices and apps to the latest versions?",
    "question5" => "How often do you use public Wi-Fi networks without additional security measures (e.g., VPN)?",
];

$label = [
    "label1" => "Question 1",
    "label2" => "Question 2",
    "label3" => "Question 3",
    "label4" => "Question 4",
    "label5" => "Question 5",
];

// Process survey results
while ($row = mysqli_fetch_assoc($result)) {
    foreach ($counts as $key => $value) {
        if ($row[$key] == "Always") {
            $counts[$key][0]++;
            $total_always++;
        } else {
            $counts[$key][1]++;
            $total_never++;
        }
    }
}

// Display results in table form
echo "<div class='container results-container'>";
echo "<h2>Survey Results</h2>";
echo "<table border='1' class='results-table'>";
echo "        <tr>
            <th>Question</th>
            <th>Always</th>
            <th>Never</th>
        </tr>";

foreach ($questions as $key => $question) {
    $always_count = $counts[$key][0];
    $never_count = $counts[$key][1];
    echo "<tr>
            <td>{$question}</td>
            <td>{$always_count}</td>
            <td>{$never_count}</td>
          </tr>";
}

// Display total counts
echo "<tr>
        <td><strong>Total</strong></td>
        <td><strong>{$total_always}</strong></td>
        <td><strong>{$total_never}</strong></td>
      </tr>";

echo "</table>";
echo "</div>"; // Close results-container

$data = [
    "labels" => array_values($label), // Questions as labels
    "question" => array_values($questions),
    "always" => [],
    "never" => []
];

foreach ($counts as $key => $value) {
    $data['always'][] = $value[0];
    $data['never'][] = $value[1];
}

// Convert PHP arrays to JSON for use in JavaScript
$jsonLabels = json_encode($data['labels']);
$jsonquestion = json_encode($data['question']);
$jsonAlways = json_encode($data['always']);
$jsonNever = json_encode($data['never']);

echo "<div style='text-align: center; margin-top: 20px;'>
        <a href='index.html' style='text-decoration: none; padding: 10px 20px; background-color: #4CAF50; color: white; border-radius: 5px; font-family: Arial, sans-serif;'>Back to Survey Form</a>
      </div>";

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container charts-container">
        <h1>Visualized Results</h1>

        <!-- Bar Chart Container -->
        <div class="chart-container">
            <canvas id="barChart"></canvas>
        </div>

        <!-- Line Chart Container -->
        <div class="chart-container">
            <canvas id="lineChart"></canvas>
        </div>

        <!-- Pie Chart Container -->
        <div class="chart-container">
            <canvas id="pieChart"></canvas>
        </div>
    </div>
    <div><center>
<!-- Button to trigger data deletion -->
<button id="deleteDataBtn" style="padding: 10px 20px; background-color: red; color: white; border-radius: 5px; font-family: Arial, sans-serif;">
    Delete All Data
</button></center></div>
<br>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data from PHP
        const labels = <?php echo $jsonLabels; ?>;
        const questions = <?php echo $jsonquestion; ?>; // Full questions from PHP
        const alwaysData = <?php echo $jsonAlways; ?>;
        const neverData = <?php echo $jsonNever; ?>;

        // Common Options for Charts
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        // Display the full question in the title of the tooltip
                        title: function(context) {
                            const index = context[0].dataIndex;
                            return questions[index];  // Show the full question based on index
                        },
                        // Customize the label to show the dataset values in the tooltip
                        label: function(context) {
                            const datasetLabel = context.dataset.label || '';
                            const dataValue = context.raw;
                            return `${datasetLabel}: ${dataValue} responses`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 10 // Smaller font size for y-axis labels
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10 // Smaller font size for x-axis labels
                        }
                    }
                }
            }
        };

        // Initialize Bar Chart
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Always',
                        data: alwaysData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Never',
                        data: neverData,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: commonOptions
        });

        // Initialize Line Chart
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Always',
                        data: alwaysData,
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2
                    },
                    {
                        label: 'Never',
                        data: neverData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderWidth: 2
                    }
                ]
            },
            options: commonOptions
        });

        // Initialize Pie Chart
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        const totalAlways = alwaysData.reduce((sum, value) => sum + value, 0);
        const totalNever = neverData.reduce((sum, value) => sum + value, 0);

        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Always', 'Never'],
                datasets: [
                    {
                        data: [totalAlways, totalNever],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: commonOptions
        });

        document.getElementById('deleteDataBtn').addEventListener('click', function() {
    const password = prompt("Please enter the password to delete all data:", "");
    if (password === "0000") {
        const confirmation = confirm("Are you sure you want to delete all the data? This action cannot be undone.");
        if (confirmation) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_data.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);  // Show server response
                    location.reload();  // Reload the page after deletion
                }
            };
            // Send the request to delete all data
            xhr.send('action=delete_all&password=' + encodeURIComponent(password));
        }
    } else {
        alert("Incorrect password. Deletion aborted.");
    }
});
    </script>
</body>
</html>
