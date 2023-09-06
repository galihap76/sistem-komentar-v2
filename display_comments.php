<?php
include 'db.php'; // Include your database connection

$output = '';

$query = "SELECT * FROM tbl_comment WHERE parent_id = 0 ORDER BY id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $output .= '
        <div class="card border border-1 p-3 mb-2 me-1 bg-white text-dark">
            <i class="bi bi-person-circle" style="font-size:30px;"> <span class="fst-normal fw-bold" style="font-size:19px;">' . $row["name"] . '</span></i>
            <div class="card-body">
                <p>' . $row["comment"] . '</p>
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary edit" data-id="' . $row["id"] . '">Edit</button>
                    <button type="button" class="btn btn-danger delete" data-id="' . $row["id"] . '">Hapus</button>
                    <button type="button" class="btn btn-primary reply" id="' . $row["id"] . '">Reply</button>
                </div>
            </div>
            <div class="col-se-5 mt-5">
                <i class="bi bi-clock"> ' . $row["comment_date"] . '</i> 
            </div>
        </div>
    ';

    $output .= get_reply($pdo, $row["id"]);
}

echo $output;

function get_reply($pdo, $parent_id = 0)
{
    $output = '';
    $query = "SELECT * FROM tbl_comment WHERE parent_id = :parent_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $output .= '
            <div class="card border border-1 p-3 mb-2 bg-white text-dark me-2" style="margin-left:30px;">
                <i class="bi bi-person-circle" style="font-size:30px;"> <span class="fst-normal fw-bold namaKomentar" style="font-size:19px;">' . $row["name"] . '</span></i>
                <div class="card-body">
                    <p class="komentar">' . $row["comment"] . '</p>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary edit" data-id="' . $row["id"] . '">Edit</button>
                        <button type="button" class="btn btn-danger delete" data-id="' . $row["id"] . '">Hapus</button>
                        <button type="button" class="btn btn-primary reply" id="' . $row["id"] . '">Reply</button>
                    </div>
                </div>
                <div class="col-se-5 mt-5">
                    <i class="bi bi-clock"> ' . $row["comment_date"] . '</i> 
                </div>
            </div>   
        ';

        $output .= get_reply($pdo, $row["id"]);
    }

    return $output;
}
