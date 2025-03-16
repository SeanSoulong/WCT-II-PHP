<?php
session_start();

class Student {
    public $id;
    public $name;
    public $age;
    public $grade;

    public function __construct($id, $name, $age, $grade) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->grade = $grade;
    }
}

class Classroom {
    public $students = [];

    public function __construct() {
        if (!isset($_SESSION['students'])) {
            $_SESSION['students'] = [];
        }
        $this->students = &$_SESSION['students'];
    }

    public function addStudent($name, $age, $grade) {
        $id = count($this->students) + 1;
        $this->students[] = new Student($id, $name, $age, $grade);
    }

    public function deleteStudent($id) {
        foreach ($this->students as $index => $student) {
            if ($student->id == $id) {
                array_splice($this->students, $index, 1);
                break;
            }
        }
    }

    public function editStudent($id, $name, $age, $grade) {
        foreach ($this->students as $student) {
            if ($student->id == $id) {
                $student->name = $name;
                $student->age = $age;
                $student->grade = $grade;
                break;
            }
        }
    }

    public function getStudents() {
        return $this->students;
    }
}

$classroom = new Classroom();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);

    if ($input['action'] === "add") {
        $classroom->addStudent($input['name'], $input['age'], $input['grade']);
    } elseif ($input['action'] === "delete") {
        $classroom->deleteStudent($input['id']);
    } elseif ($input['action'] === "edit") {
        $classroom->editStudent($input['id'], $input['name'], $input['age'], $input['grade']);
    }
}

header('Content-Type: application/json');
echo json_encode($classroom->getStudents());
?>
