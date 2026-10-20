<?php
require 'config/db.php';
include 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM applications ORDER BY id DESC");
$applications = $stmt->fetchAll();
?>

<div class="container">
    <h1>Game Developer Job Applications</h1>
    <a href="create.php" class="btn">+ New Application</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Experience</th>
            <th>Skills</th>
            <th>Education</th>
            <th>Date Applied</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($applications as $app): ?>
        <tr>
            <td><?= $app['id'] ?></td>
            <td><?= htmlspecialchars($app['full_name']) ?></td>
            <td><?= htmlspecialchars($app['email']) ?></td>
            <td><?= htmlspecialchars($app['phone']) ?></td>
            <td><?= htmlspecialchars($app['position']) ?></td>
            <td><?= $app['experience_years'] ?> yrs</td>
            <td><?= htmlspecialchars($app['skills']) ?></td>
            <td><?= htmlspecialchars($app['education']) ?></td>
            <td><?= $app['created_at'] ?></td>
            <td>
                <a href="edit.php?id=<?= $app['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $app['id'] ?>" onclick="return confirm('Delete this application?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include 'includes/footer.php'; ?>