<?php
if (isset($_GET['projectsAssign'])) {
    $projectID = $_GET['projectsAssign'];
    ob_clean(); ?>
    <tr>
        <?php $column_index = 0;
        foreach ($ProjectsColumns as $column) {
            $column_index++; ?>
            <th><? echo $column ?></th>
        <?php if ($column_index == 1) {
                echo "<th>Employees</th>";
            } else {
                continue;
            }
        } ?>
        <th style="text-align: center;">Actions</th>
    </tr>
    <?php foreach ($projects as $project) {
        $id = $project->getID();
        $query = $entityManager->createQuery("SELECT CONCAT(u.name, ' ', u.surname) as fullname FROM Employee u WHERE u.project_id = $id GROUP BY u.id")->getResult(); ?>
        <tr>
            <td><? echo $project->getID() ?></td>
            <td><? echo group($query) ?></td>
            <td><? echo $project->getName() ?></td>
            <td><? echo $project->getDeadline() ?></td>
            <td style="text-align: center;">
                <a class='btn' href="index.php?projectsDel=<?= $id ?>">Del</a>
                <a class='btn' href="index.php?projectsEdit=<?= $id ?>">Edit</a>
                <a class='btn' href="index.php?projectsAssign=<?= $id ?>">Assign</a>
                <a class='btn' href="index.php?removeEmployee=<?= $id ?>">Remove</a>
            </td>
        </tr>
    <?php } ?>
    </table>
    <form action="" method="post" autocomplete="off">
        Select employee: <select name="projects" id="projects">
            <?php foreach ($employees as $employee) { ?>
                <option value="<?= $employee->getID() ?>"><?= $employee->getName() . ' ' . $employee->getSurname() ?></option>
            <?php } ?>
            <option value="NULL">-</option>
        </select>
        <div><a class='btn' href="index.php?projects">Cancel</a></div>
        <input class='btn' type="submit" value="Assign">
    </form>
<?php
    if (isset($_POST['projects'])) {
        $employeeID = $_POST['projects'];
        $findProject = $entityManager->find('Project', $projectID);
        $findEmployee = $entityManager->find('Employee', $employeeID);
        $findEmployee->setProjectID($findProject);
        $entityManager->flush();
        header('Location: ./index.php?projects');
    }
}
?>