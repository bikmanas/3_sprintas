<?php
if (isset($_GET['projectsAdd'])) {  ?>
    <form action="" method="post" autocomplete="off">
        *Enter project name: <input type="text" name="pname" placeholder="name">
        Date: <input type="text" name="pdl" placeholder="yyyy-mm-dd">
        <input class='btn' type="submit" value="Add">
        <div><a class='btn' href="index.php?projects">Cancel</a></div>
    </form>
    <?php
    $date = date_create();
    date_add($date, date_interval_create_from_date_string("7 days"));
    $futureDate = date_format($date, "Y-m-d");
    $pdl = !empty($_POST['pdl']) ? $_POST['pdl'] : $futureDate;
    if (isset($_POST['pname'])) {
        $pname = $_POST['pname'];
        $project = new Project();
        $project->setName($pname);
        $project->setDeadline($pdl);

        $entityManager->persist($project);
        $entityManager->flush();
        header('Location: ./index.php?projects');
    }
}
if (isset($_GET['employeeAdd'])) { ?>
    <form action="" method="post" autocomplete="off">
        *Enter name: <input type="text" name="fname" placeholder="first name">
        *Enter last name: <input type="text" name="lname" placeholder="last name">
        *Enter role: <input type="text" name="role" placeholder="job description">
        Select Project: <select name="projects" id="projects">
            <option value="NULL">-</option>
            <?php foreach ($projects as $project) { ?>
                <option value="<?= $project->getID() ?>"><?= $project->getName() ?></option>
            <?php } ?>
        </select>
        <input class='btn' type="submit" value="Add">
        <div><a class='btn' href="index.php">Cancel</a></div>
    </form>
<?php
    if (isset($_POST['fname']) && isset($_POST['lname'])) {
        $projectID = $entityManager->find('Project', $_POST['projects']);
        $name = $_POST['fname'];
        $surname = $_POST['lname'];
        $role = empty($_POST['role']) ? '-' : $_POST['role'];

        $employee = new Employee();
        $employee->setName($name);
        $employee->setSurname($surname);
        $employee->setRole($role);
        $employee->setProjectID($projectID);
        $entityManager->persist($employee);
        $entityManager->flush();
        header('Location: ./index.php');
    }
}

?>