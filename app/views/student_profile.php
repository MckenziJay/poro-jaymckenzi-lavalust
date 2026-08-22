<! DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
</head>
<body>
    <a href=" <?= site_url('student');?>">Home</a>
    <a href=" <?= site_url('student/profile');?>">Profile</a>

   <p>Student ID: <?php echo $student['student_id']; ?></p>
    <p>Name: <?php echo $student['name']; ?></p>
    <p>Course: <?php echo $student['course']; ?></p>
    <p>Year Level: <?php echo $student['year']; ?></p>
    <p>Section: <?php echo $student['section']; ?></p>
    <p>Email: <?php echo $student['email']; ?></p>
</body>
</html>