<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Scary Story Pumpkin 🎃</title>
</head>
<body>

    <h1>🎃 Scary Story Pumpkin 🎃</h1>
    <div class="container">
        <p>Welcome! Add your scary story to the pumpkin, or read what others have shared...</p>
        
        <form method="POST" action="">
            <textarea id="storyInput" name="story" placeholder="Enter your scary story here..."></textarea>
            <button type="submit">Add Story</button>
        </form>
        <button onclick="viewStories()">View Stories</button>
        
        <div id="storyContainer">
            <?php
            include 'db_connection.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['story'])) {
                $storyText = $conn->real_escape_string(trim($_POST['story']));
                $sql = "INSERT INTO stories (story_text) VALUES ('$storyText')";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Your story has been added to the pumpkin!');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            function fetchStories($conn) {
                $sql = "SELECT * FROM stories";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='story'><strong>Story #{$row['id']}:</strong><br>{$row['story_text']}</div>";
                    }
                } else {
                    echo "<p>The pumpkin is empty... No scary stories yet.</p>";
                }
            }

            fetchStories($conn);
            $conn->close();
            ?>
        </div>
    </div>

    <script>
        function viewStories() {
            location.reload();
        }
    </script>

</body>
</html>