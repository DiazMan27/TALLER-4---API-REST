<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, HEAD, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todos los proyectos o uno específico
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $conn->prepare("SELECT * FROM proyectos WHERE id = ?");
            $stmt->bind_param("i", $id);
        } else {
            $stmt = $conn->prepare("SELECT * FROM proyectos");
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        $proyectos = [];
        
        while($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
        echo json_encode($proyectos);
        break;

    case 'POST':
        // Crear nuevo proyecto
        $data = json_decode(file_get_contents("php://input"), true);
        
        // Validación básica
        if (empty($data['titulo']) || empty($data['descripcion'])) {
            http_response_code(400);
            echo json_encode(["error" => "Título y descripción son requeridos"]);
            exit;
        }
        
        $stmt = $conn->prepare("INSERT INTO proyectos (titulo, descripcion, imagen, enlace) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", 
            $data['titulo'], 
            $data['descripcion'], 
            $data['imagen'] ?? null, 
            $data['enlace'] ?? null
        );
        
        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode([
                "message" => "Proyecto creado correctamente",
                "id" => $conn->insert_id
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'PUT':
        // Actualizar proyecto completo
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "ID es requerido"]);
            exit;
        }
        
        $id = intval($_GET['id']);
        $data = json_decode(file_get_contents("php://input"), true);
        
        // Validación
        if (empty($data['titulo']) || empty($data['descripcion'])) {
            http_response_code(400);
            echo json_encode(["error" => "Título y descripción son requeridos"]);
            exit;
        }
        
        $stmt = $conn->prepare("UPDATE proyectos SET titulo=?, descripcion=?, imagen=?, enlace=? WHERE id=?");
        $stmt->bind_param("ssssi", 
            $data['titulo'], 
            $data['descripcion'], 
            $data['imagen'] ?? null, 
            $data['enlace'] ?? null,
            $id
        );
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Proyecto actualizado completamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'PATCH':
        // Actualización parcial
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "ID es requerido"]);
            exit;
        }
        
        $id = intval($_GET['id']);
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(["error" => "No hay datos para actualizar"]);
            exit;
        }
        
        // Construir consulta dinámica
        $fields = [];
        $types = "";
        $values = [];
        
        foreach ($data as $key => $value) {
            if (in_array($key, ['titulo', 'descripcion', 'imagen', 'enlace'])) {
                $fields[] = "$key = ?";
                $types .= "s";
                $values[] = $value;
            }
        }
        
        if (empty($fields)) {
            http_response_code(400);
            echo json_encode(["error" => "No hay campos válidos para actualizar"]);
            exit;
        }
        
        $values[] = $id;
        $types .= "i";
        
        $sql = "UPDATE proyectos SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Proyecto actualizado parcialmente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'DELETE':
        // Eliminar proyecto
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "ID es requerido"]);
            exit;
        }
        
        $id = intval($_GET['id']);
        $stmt = $conn->prepare("DELETE FROM proyectos WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            echo json_encode(["message" => "Proyecto eliminado correctamente"]);
        } else {
            http_response_code(500);
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'HEAD':
        // Verificar existencia de recurso
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $stmt = $conn->prepare("SELECT id FROM proyectos WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                http_response_code(200);
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(200); // Asumimos que el endpoint existe
        }
        break;

    case 'OPTIONS':
        // Para preflight requests de CORS
        http_response_code(200);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Método no permitido"]);
        break;
}

$conn->close();
?>