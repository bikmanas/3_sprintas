<?php
if (isset($_GET['removeEmployee'])) {
    ob_clean();
    $removeEmployee = $_GET['removeEmployee'];
    // $employee = $entityManager->find('Employee', $removeEmployee);
    $employee = $entityManager->getRepository('Employee')->findBy(array('project_id' => $removeEmployee)); ?>
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
    <form action="" method="post">
        Remove employee: <select name="selectEmployee" id="">
            <?php foreach ($employee as $single) { ?>
                <option value="<?= $single->getID() ?>"><?= $single->getName(); ?> <?= $single->getSurname() ?></option>
            <?php  } ?>
        </select>
        <div><a class='btn' href="index.php?projects">Cancel</a></div>
        <input class='btn' type="submit" value="Remove">
    </form>
<?php
    if (isset($_POST['selectEmployee'])) {
        $selectedEmployee = $_POST['selectEmployee'];
        $employee = $entityManager->find('Employee', $selectedEmployee);
        $employee->setProjectID(NULL);
        $entityManager->persist($project);
        $entityManager->flush();
        header('Location: ./index.php?projects');
    }
}
?>