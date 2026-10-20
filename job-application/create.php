<?php
require 'config/db.php';
include 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO applications 
        (full_name, email, phone, position, experience_years, skills, education) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['full_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['position'],
        $_POST['experience_years'],
        $_POST['skills'],
        $_POST['education']
    ]);
    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <h2>Game Developer Job Application</h2>
    <form method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Phone</label>
        <input type="text" name="phone">

        <label>Position Applying For</label>
        <select name="position" required>
            <option value="">-- Select Position --</option>
            <option>Gameplay Programmer</option>
            <option>Unity Developer</option>
            <option>Unreal Engine Developer</option>
            <option>Game Designer</option>
            <option>Technical Artist</option>
            <option>Mobile Game Developer</option>
        </select>

        <label>Years of Experience</label>
        <input type="number" name="experience_years" min="0" value="0">

        <label>Skills / Game Engines & Languages</label>
        <textarea name="skills" rows="3" placeholder="e.g. Unity, C#, Unreal Engine, C++, Godot, Blender"></textarea>

        <label>Education</label>
        <input type="text" name="education" placeholder="e.g. BS Game Development / Computer Science">

        <br><br>
        <button type="submit">Submit Application</button>
        <a href="index.php">Cancel</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>