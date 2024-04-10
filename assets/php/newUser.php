<?php
session_start(); // Startet die Sitzung, um Daten zwischen den Anfragen zu speichern

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['speichern'])) {
    // Extrahieren und Bereinigen der Daten aus dem Formular
    $vorname = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_STRING);
    $nachname = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_STRING);
    // Fügen Sie hier zusätzliche Daten hinzu...

    // Speichern Sie die Formulardaten in der Session, um sie erneut auszufüllen, falls benötigt
    $_SESSION['form_data'] = $_POST;

    // Verbinden zur Datenbank und Daten einfügen
    try {
        $pdo = new PDO('mysql:host=ebicogeh.mysql.db.internal;dbname=ebicogeh_Dashboard;charset=utf8', 'ebicogeh_dashbo', 'GvWjZwfK!XV4bDDLkWApAnT@');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "INSERT INTO kunden (vorname, nachname, firma, email, passwort_hash, adresse1, adresse2, stadt, kanton, plz, twitter, facebook, instagram, bio) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        // Passwort sollte als Hash gespeichert werden
        $passwort_hash = password_hash($_POST['passwort'], PASSWORD_DEFAULT);
        
        $stmt->execute([
            $vorname, 
            $nachname, 
            $_POST['firma'], 
            $_POST['email'], 
            $passwort_hash,
            $_POST['adresse1'],
            $_POST['adresse2'],
            $_POST['stadt'],
            $_POST['kanton'],
            $_POST['plz'],
            $_POST['twitter'],
            $_POST['facebook'],
            $_POST['instagram'],
            $_POST['bio']
        ]);

        echo "Daten erfolgreich gespeichert.";

    } catch (PDOException $e) {
        die("Datenbankfehler: " . $e->getMessage());
    }
} elseif (!isset($_SESSION['form_data'])) {
    $_SESSION['form_data'] = array_fill_keys(['vorname', 'nachname', 'firma', 'email', 'adresse1', 'adresse2', 'stadt', 'kanton', 'plz', 'twitter', 'facebook', 'instagram', 'bio'], '');
}
?>
