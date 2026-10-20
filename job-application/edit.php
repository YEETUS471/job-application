<?php
require 'config/db.php';
include 'includes/header.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM applications WHERE id = ?");
$stmt->execute([$id]);
$app = $stmt->fetch();

if (!$app) {
    die("Application not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE applications SET 
        full_name=?, email=?, phone=?, position=?, experience_years=?, skills=?, education=? 
        WHERE id=?");
    $stmt->execute([
        $_POST['full_name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['position'],
        $_POST['experience_years'],
        $_POST['skills'],
        $_POST['education'],
        $id
    ]);
    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <h2>Edit Application</h2>
    <form method="post">
        <label>Full Name</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($app['full_name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($app['email']) ?>" required>

        <label>Phone</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($app['phone']) ?>">

        <label>Position Applying For</label>
        <select name="position" required>
            <?php
            $positions = [
                'Gameplay Programmer',
                'Unity Developer',
                'Unreal Engine Developer',
                'Game Designer',
                'Technical Artist',
                'Mobile Game Developer'
            ];
            foreach ($positions as $pos) {
                $selected = ($app['position'] === $pos) ? 'selected' : '';
                echo "<option value=\"$pos\" $selected>$pos</option>";
            }
            ?>
        </select>

        <label>Years of Experience</label>
        <input type="number" name="experience_years" value="<?= $app['experience_years'] ?>" min="0">

        <label>Skills / Game Engines & Languages</label>
        <textarea name="skills" rows="3"><?= htmlspecialchars($app['skills']) ?></textarea>

        <label>Education</label>
        <input type="text" name="education" value="<?= htmlspecialchars($app['education']) ?>">

        <br><br>
        <button type="submit">Update Application</button>
        <a href="index.php">Cancel</a>
    </form>
</div>

<?php include 'includes/footer.php'; ?>