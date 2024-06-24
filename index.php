<!DOCTYPE html>
<html lang="en">
<?php
include 'db.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = (isset($_GET['per-page']) && (int)($_GET['per-page']) <= 50) ? $_GET['per-page'] : 5;
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;
$sql = "SELECT * FROM taskslist LIMIT " . $start . "," . $perPage . "";
$total = $db->query("SELECT * FROM taskslist")->num_rows;
$pages = ceil($total / $perPage);
$rows = $db->query($sql);

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo List</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
  <div class="container">
    <div class="row d-flex justify-content-center">
      <h1>ToDo List</h1>
      <div class="col-md-10 offset-md-1">
        <table class="table table-hover">
          <div class="d-flex justify-content-between">
            <button type="button" data-target="#myModal" data-toggle="modal" class="btn btn-success">Add Task</button>
            <button type="button" class="btn btn-outline-dark" onclick="print()">Print</button>
          </div>
          <hr><br>
          <!-- modal content -->
          <div id="myModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Add Task</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form method="post" action="add.php">
                    <div class="form-group">
                      <label>Task name</label>
                      <input type="text" required name="task" class="form-control">
                    </div>
                    <input type="submit" name="send" value="AddTask" class="btn btn-success">
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 text-center">
            <p>Search</p>
            <form action="search.php" method="post" class="form-group">
              <input type="text" name="search" placeholder="Search" class="form-control">
            </form>
          </div>
          <thead>
            <tr>
              <th scope=" col">ID.</th>
              <th scope="col">Task</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php while ($row = $rows->fetch_assoc()) : ?>

                <th><?php echo $row['id'] ?></th>
                <td class="col-md-10"><?php echo $row['name'] ?></td>
                <td class="d-flex">
                  <a href="update.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-warning mr-2">Edit</button></a>
                  <a href="delete.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                </td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
        <div class="row d-flex justify-content-center">
          <ul class="pagination">
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
              <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

</body>

</html>