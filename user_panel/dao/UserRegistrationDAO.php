<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../models/UserRegistration.php';

class UserRegistrationDAO {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Save new user
    public function save(UserRegistration $user) {
        $sql = "
            INSERT INTO user_registration (
                first_name, last_name, phone_number, email, father_name, father_occupation,
                tenth_board, tenth_percentage, tenth_year,
                twelfth_board, twelfth_percentage, twelfth_year,
                graduation_university, graduation_percentage, graduation_year,
                passport, description
            ) VALUES (
                :first_name, :last_name, :phone_number, :email, :father_name, :father_occupation,
                :tenth_board, :tenth_percentage, :tenth_year,
                :twelfth_board, :twelfth_percentage, :twelfth_year,
                :graduation_university, :graduation_percentage, :graduation_year,
                :passport, :description
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name,
            ':phone_number' => $user->phone_number,
            ':email' => $user->email,
            ':father_name' => $user->father_name,
            ':father_occupation' => $user->father_occupation,
            ':tenth_board' => $user->tenth_board,
            ':tenth_percentage' => $user->tenth_percentage,
            ':tenth_year' => $user->tenth_year,
            ':twelfth_board' => $user->twelfth_board,
            ':twelfth_percentage' => $user->twelfth_percentage,
            ':twelfth_year' => $user->twelfth_year,
            ':graduation_university' => $user->graduation_university,
            ':graduation_percentage' => $user->graduation_percentage,
            ':graduation_year' => $user->graduation_year,
            ':passport' => $user->passport,
            ':description' => $user->description,
        ]);
    }

    // Update existing user
    public function update(UserRegistration $user) {
        $sql = "
            UPDATE user_registration SET
                first_name = :first_name,
                last_name = :last_name,
                phone_number = :phone_number,
                email = :email,
                father_name = :father_name,
                father_occupation = :father_occupation,
                tenth_board = :tenth_board,
                tenth_percentage = :tenth_percentage,
                tenth_year = :tenth_year,
                twelfth_board = :twelfth_board,
                twelfth_percentage = :twelfth_percentage,
                twelfth_year = :twelfth_year,
                graduation_university = :graduation_university,
                graduation_percentage = :graduation_percentage,
                graduation_year = :graduation_year,
                passport = :passport,
                description = :description
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name,
            ':phone_number' => $user->phone_number,
            ':email' => $user->email,
            ':father_name' => $user->father_name,
            ':father_occupation' => $user->father_occupation,
            ':tenth_board' => $user->tenth_board,
            ':tenth_percentage' => $user->tenth_percentage,
            ':tenth_year' => $user->tenth_year,
            ':twelfth_board' => $user->twelfth_board,
            ':twelfth_percentage' => $user->twelfth_percentage,
            ':twelfth_year' => $user->twelfth_year,
            ':graduation_university' => $user->graduation_university,
            ':graduation_percentage' => $user->graduation_percentage,
            ':graduation_year' => $user->graduation_year,
            ':passport' => $user->passport,
            ':description' => $user->description,
            ':id' => $user->id,
        ]);
    }

    // ❌ Delete user by ID
    public function delete($id) {
        $sql = "DELETE FROM user_registration WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // 📥 Fetch user by ID
    public function getById($id) {
        $sql = "SELECT * FROM user_registration WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 📋 Get all users
    public function getAll() {
        $sql = "SELECT * FROM user_registration ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
