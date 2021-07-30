<?php 
    if (isset($_GET['projectsDel'])) {
        $delete = $_GET['projectsDel'];
        $project = $entityManager->find('Project', $delete);
        $entityManager->remove($project);
        $entityManager->flush();
        header('Location: ./index.php?projects');
    } else if (
        isset($_GET['employeeDel'])) {
            $delete = $_GET['employeeDel'];
            $employee = $entityManager->find('Employee', $delete);
            $entityManager->remove($employee);
            $entityManager->flush();
            header('Location: index.php');
        }
