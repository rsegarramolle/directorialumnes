<?php
// Funció per llegir tots els fitxers JSON dels alumnes
function llegirAlumnes() {
    $alumnes = [];
    $directori = 'alumnes/';
    
    if (is_dir($directori)) {
        $fitxers = glob($directori . '*.json');
        foreach ($fitxers as $fitxer) {
            $contingut = file_get_contents($fitxer);
            $alumne = json_decode($contingut, true);
            if ($alumne) {
                $alumnes[] = $alumne;
            }
        }
    }
    
    return $alumnes;
}

// Llegir alumnes
$alumnes = llegirAlumnes();
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directori d'Alumnes de l'INS Mollerussa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Directori d'Alumnes de l'INS Mollerussa</h1>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Cerca alumnes per nom, cognoms, email, estudi o curs..." autocomplete="off">
                <div class="search-icon">🔍</div>
            </div>
        </header>

        <main>
            <div class="students-grid" id="studentsGrid">
                <?php if (empty($alumnes)): ?>
                    <div class="no-students">
                        <p>No s'han trobat alumnes.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($alumnes as $alumne): ?>
                        <div class="student-card" data-name="<?php echo htmlspecialchars(strtolower($alumne['nom'] . ' ' . $alumne['cognoms'])); ?>" data-email="<?php echo htmlspecialchars(strtolower($alumne['email'])); ?>" data-estudi="<?php echo htmlspecialchars(strtolower($alumne['estudi'] ?? '')); ?>" data-curs="<?php echo htmlspecialchars(strtolower($alumne['curs'] ?? '')); ?>">
                            <div class="student-info">
                                <h3><?php echo htmlspecialchars($alumne['nom'] . ' ' . $alumne['cognoms']); ?></h3>
                                <p class="email"><?php echo htmlspecialchars($alumne['email']); ?></p>
                                <div class="student-details">
                                    <span class="estudi"><?php echo htmlspecialchars($alumne['estudi'] ?? 'No especificat'); ?></span>
                                    <span class="curs"><?php echo htmlspecialchars($alumne['curs'] ?? 'No especificat'); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <script>
        // Funcionalitat de cerca
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const studentCards = document.querySelectorAll('.student-card');
            
            studentCards.forEach(card => {
                const name = card.getAttribute('data-name');
                const email = card.getAttribute('data-email');
                const estudi = card.getAttribute('data-estudi');
                const curs = card.getAttribute('data-curs');
                
                if (name.includes(searchTerm) || 
                    email.includes(searchTerm) || 
                    estudi.includes(searchTerm) || 
                    curs.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Mostrar missatge si no hi ha resultats
            const visibleCards = Array.from(studentCards).filter(card => card.style.display !== 'none');
            const noResults = document.querySelector('.no-results');
            
            if (visibleCards.length === 0 && searchTerm !== '') {
                if (!noResults) {
                    const grid = document.getElementById('studentsGrid');
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.innerHTML = '<p>No s\'han trobat alumnes que coincideixin amb la cerca.</p>';
                    grid.appendChild(noResultsDiv);
                }
            } else if (noResults) {
                noResults.remove();
            }
        });
    </script>
</body>
</html>
