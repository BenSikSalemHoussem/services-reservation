<?php
$title = 'Nos Services';
require_once '../../init.php';
include '../includes/header.php';
?>
<h2>Nos Services</h2>
<div class="row">
    <?php if (empty($services)): ?>
        <div class="col-md-12">
            <p>Aucun service disponible pour le moment.</p>
        </div>
    <?php else: ?>
        <?php foreach ($services as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php if ($service['image_path']): ?>
                        <img src="../../<?php echo htmlspecialchars($service['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($service['nom']); ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200?text=Pas+d'image" class="card-img-top" alt="Pas d'image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($service['nom']); ?></h5>
                        <p class="card-text"><?php echo substr(htmlspecialchars($service['description']), 0, 100); ?>...</p>
                        <p class="card-text"><small class="text-muted">Prix: <?php echo htmlspecialchars($service['prix']); ?> €</small></p>
                        <a href="details.php?service_id=<?php echo htmlspecialchars($service['id']); ?>" class="btn btn-primary">Détails et Réserver</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php include '../includes/footer.php'; ?>