<?php
if (isset($_GET['projectsEdit'])) {
    $editProject = $_GET['projectsEdit'];
    $projects = $entityManager->getRepository('Project')->findAll();
    $getProject = $entityManager->find('Project', $editProject);

?>
    <form action="" method="post" autocomplete="off">
        Name: <input type="text" name="update-pname" value="<?= $getProject->getName() ?>">
        Deadline: <input type="text" name="upd-dl" value="<?= $getProject->getDeadline() ?>">
        <input class="btn" type="submit" value="Update">
        <div><a class='btn' href="index.php?projects">Cancel</a></div>
    </form>
    <?php
    if (isset($_POST['update-pname']) || isset($_POST['upd-dl'])) {
        $name = $_POST['update-pname'];
        $deadline = !empty($_POST['upd-dl']) ? $_POST['upd-dl'] : $getProject->getDeadline();
        $getProject->setName($name);
        $getProject->setDeadline($deadline);
        $entityManager->flush();
        header('Location: ./index.php?projects');
    }
} else if (isset($_GET['employeeEdit'])) {
    $editEmployee = $_GET['employeeEdit'];
    $employees = $entityManager->getRepository('Employee')->findAll();
    $employee = $entityManager->find('Employee', $editEmployee);
    ?>
    <form action="" method="post" autocomplete="off">
        Name: <input type="text" name="update-fname" value="<?= $employee->getName() ?>">
        Surname: <input type="text" name="update-lname" value="<?= $employee->getSurname() ?>">
        Role: <input type="text" name="update-role" value="<?= $employee->getRole() ?>">
        Project: <select name="projects" id="projects">
            <?php foreach ($projects as $project) { ?>
                <option value="<?= $project->getID() ?>"><?= $project->getName() ?></option>
            <?php } ?>
            <option value="NULL">-</option>
        </select>
        <input class="btn" type="submit" value="Update">
        <div><a class='btn' href="index.php">Cancel</a></div>
    </form>
<?php
    if (isset($_POST['update-fname']) || isset($_POST['update-lname']) || isset($_POST['update-role']) || isset($_POST['projects'])) {
        $name = $_POST['update-fname'];
        $surname = $_POST['update-lname'];
        $role = $_POST['update-role'];
        $project = $_POST['projects'];
        $projectID = $entityManager->find('Project', $project);
        $employee->setName($name);
        $employee->setSurname($surname);
        $employee->setRole($role);
        $employee->setProjectID($projectID);
        $entityManager->flush();
        header('Location: ./index.php');
    }
}
?>