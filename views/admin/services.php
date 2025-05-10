<?php
$title = 'Gestion des Services';
require_once '../../init.php';
include '../includes/header.php';
if (!isAdmin()) {
    redirect('../../index.php');
}
include '../includes/admin_nav.php';
?>
<h2>Gestion des Services</h2>
<h3>Ajouter un nouveau service</h3>
<form action="../../controllers/ServiceController.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom du service</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="prix" class="form-label">Prix (€)</label>
        <input type="number" class="form-control" id="prix" name="prix" min="0.01" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image du service</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
        <small class="form-text text-muted">Formats acceptés: JPG, JPEG, PNG, GIF.</small>
    </div>
    <button type="submit" class="btn btn-primary" name="add_service">Ajouter le service</button>
</form>

<hr>

<h3>Services existants</h3>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($services as $service): ?>
            <tr>
                <td><?php echo htmlspecialchars($service['id']); ?></td>
                <td><?php echo htmlspecialchars($service['nom']); ?></td>
                <td><?php echo htmlspecialchars($service['prix']); ?> €</td>
                <td>
                    <?php if ($service['image_path']): ?>
                        <img src="../../<?php echo htmlspecialchars($service['image_path']); ?>" alt="<?php echo htmlspecialchars($service['nom']); ?>" width="50">
                    <?php else: ?>
                        Pas d'image
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editServiceModal<?php echo $service['id']; ?>">Modifier</button>
                    <a href="../../controllers/ServiceController.php?delete_service=<?php echo $service['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?')">Supprimer</a>

                    <div class="modal fade" id="editServiceModal<?php echo $service['id']; ?>" tabindex="-1" aria-labelledby="editServiceModalLabel<?php echo $service['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editServiceModalLabel<?php echo $service['id']; ?>">Modifier le service: <?php echo htmlspecialchars($service['nom']); ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../controllers/ServiceController.php" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['id']); ?>">
                                        <div class="mb-3">
                                            <label for="edit_nom<?php echo $service['id']; ?>" class="form-label">Nom du service</label>
                                            <input type="text" class="form-control" id="edit_nom<?php echo $service['id']; ?>" name="nom" value="<?php echo htmlspecialchars($service['nom']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_description<?php echo $service['id']; ?>" class="form-label">Description</label>
                                            <textarea class="form-control" id="edit_description<?php echo $service['id']; ?>" name="description" rows="3" required><?php echo htmlspecialchars($service['description']); ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_prix<?php echo $service['id']; ?>" class="form-label">Prix (€)</label>
                                            <input type="number" class="form-control" id="edit_prix<?php echo $service['id']; ?>" name="prix" min="0.01" step="0.01" value="<?php echo htmlspecialchars($service['prix']); ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="edit_image<?php echo $service['id']; ?>" class="form-label">Modifier l'image (facultatif)</label>
                                            <input type="file" class="form-control" id="edit_image<?php echo $service['id']; ?>" name="image" accept="image/*">
                                            <?php if ($service['image_path']): ?>
                                                <small class="form-text text-muted">Image actuelle: <?php echo basename(htmlspecialchars($service['image_path'])); ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary" name="edit_service">Enregistrer les modifications</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../includes/footer.php'; ?>