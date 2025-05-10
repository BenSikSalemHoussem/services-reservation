<?php
$serviceModel = new Service($db);

if (isset($_GET['service_id'])) {
    $service = $serviceModel->getServiceById($_GET['service_id']);
    if (!$service) {
        displayAlert('danger', 'Service non trouvé.');
        redirect('views/services/index.php');
    }
}

$services = $serviceModel->getAllServices();

// Controller pour l'ajout de service (Admin)
if (isAdmin() && isset($_POST['add_service'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    if (!Validator::string($nom, 2, 100)) {
        displayAlert('danger', 'Le nom du service doit contenir entre 2 et 100 caractères.');
    } elseif (!Validator::string($description, 10)) {
        displayAlert('danger', 'La description du service doit contenir au moins 10 caractères.');
    } elseif (!Validator::numeric($prix) || $prix <= 0) {
        displayAlert('danger', 'Le prix doit être un nombre positif.');
    } else {
        $image_path = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/uploads/services/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image_path = $uploadFile;
            } else {
                displayAlert('warning', 'Erreur lors de l\'upload de l\'image.');
            }
        }

        if ($serviceModel->createService($nom, $description, $prix, $image_path)) {
            displayAlert('success', 'Service ajouté avec succès.');
            redirect('views/admin/services.php');
        } else {
            displayAlert('danger', 'Une erreur est survenue lors de l\'ajout du service.');
        }
    }
    redirect('views/admin/services.php');
}

// Controller pour la modification de service (Admin)
if (isAdmin() && isset($_POST['edit_service'])) {
    $id = $_POST['service_id'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];

    $existingService = $serviceModel->getServiceById($id);
    if (!$existingService) {
        displayAlert('danger', 'Service non trouvé.');
        redirect('views/admin/services.php');
    }

    if (!Validator::string($nom, 2, 100)) {
        displayAlert('danger', 'Le nom du service doit contenir entre 2 et 100 caractères.');
    } elseif (!Validator::string($description, 10)) {
        displayAlert('danger', 'La description du service doit contenir au moins 10 caractères.');
    } elseif (!Validator::numeric($prix) || $prix <= 0) {
        displayAlert('danger', 'Le prix doit être un nombre positif.');
    } else {
        $image_path = $existingService['image_path']; // Conserver l'ancienne image par défaut
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/uploads/services/';
            $uploadFile = $uploadDir . basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                // Supprimer l'ancienne image si elle existe
                if ($existingService['image_path'] && file_exists($existingService['image_path'])) {
                    unlink($existingService['image_path']);
                }
                $image_path = $uploadFile;
            } else {
                displayAlert('warning', 'Erreur lors de l\'upload de la nouvelle image.');
            }
        }

        if ($serviceModel->updateService($id, $nom, $description, $prix, $image_path)) {
            displayAlert('success', 'Service mis à jour avec succès.');
            redirect('views/admin/services.php');
        } else {
            displayAlert('danger', 'Une erreur est survenue lors de la mise à jour du service.');
        }
    }
    redirect('views/admin/services.php');
}

// Controller pour la suppression de service (Admin)
if (isAdmin() && isset($_GET['delete_service'])) {
    $id = $_GET['delete_service'];
    $serviceToDelete = $serviceModel->getServiceById($id);

    if (!$serviceToDelete) {
        displayAlert('danger', 'Service non trouvé.');
        redirect('views/admin/services.php');
    }

    if ($serviceModel->deleteService($id)) {
        // Supprimer l'image associée si elle existe
        if ($serviceToDelete['image_path'] && file_exists($serviceToDelete['image_path'])) {
            unlink($serviceToDelete['image_path']);
        }
        displayAlert('success', 'Service supprimé avec succès.');
    } else {
        displayAlert('danger', 'Une erreur est survenue lors de la suppression du service.');
    }
    redirect('views/admin/services.php');
}

?>