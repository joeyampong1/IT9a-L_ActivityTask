<?php
require 'db_connection.php';

// Initialize variables
$patient = [];
$consultations = [];

try {
    // Fetch patients 
    $stmt = $healthcare_db->query("SELECT * FROM patient ORDER BY patient_id DESC");
    $patient = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching patients: " . $e->getMessage();
}

try {
    // Fetch consultations with joins 
    $stmt = $healthcare_db->query("
        SELECT c.consultation_id,
               p.full_name, 
               c.doctor_name, 
               c.consultation_date, 
               c.diagnosis,
               c.treatment
        FROM consultations c
        LEFT JOIN patient p ON c.patient_id = p.patient_id
        ORDER BY c.consultation_date DESC
    ");
    $consultations = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error fetching consultations: " . $e->getMessage();
}
?>