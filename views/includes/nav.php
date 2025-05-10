<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <a class="navbar-brand" href="index.php">Réservation Services</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="views/services/index.php">Services</a>
            </li>
            <?php if (isLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="views/user/profile.php">Mon Compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?logout">Déconnexion</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="views/auth/login.php">Se Connecter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="views/auth/register.php">S'inscrire</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>