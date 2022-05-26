<?php 
  class Post {
    // DB stuff
    //test
    private $conn;
    private $table = 'products';

    // Post Properties
    public $id;
    public $nama_barang;
    public $stock;
    public $merek;
    public $category;
    public $harga; 
    public $warna; 
    public $size;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT * FROM ' . $this->table . ' ORDER BY Id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    public function update() {
      // Create query
      $query = 'UPDATE ' . $this->table . '
                            SET id = :id, nama_barang = :nama_barang, stock = :stock, merek = :merek, category = :category, harga = :harga, warna = :warna, size = :size
                            WHERE id = :id';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->nama_barnag = htmlspecialchars(strip_tags($this->nama_barang));
      $this->stock = htmlspecialchars(strip_tags($this->stock));
      $this->merek = htmlspecialchars(strip_tags($this->merek));
      $this->category = htmlspecialchars(strip_tags($this->category));
      $this->harga = htmlspecialchars(strip_tags($this->harga));
      $this->warna = htmlspecialchars(strip_tags($this->warna));
      $this->size = htmlspecialchars(strip_tags($this->size));

      // Bind data
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':nama_barang', $this->nama_barang);
      $stmt->bindParam(':stock', $this->stock);
      $stmt->bindParam(':merek', $this->merek);
      $stmt->bindParam(':category', $this->category);
      $stmt->bindParam(':harga', $this->harga);
      $stmt->bindParam(':warna', $this->warna);
      $stmt->bindParam(':size', $this->size);

      // Execute query
      if($stmt->execute()) {
        return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
  }

  // Delete Post
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }



    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->id = $row['Id'];
          $this->nama_barang = $row['nama_barang'];
          $this->stock = $row['stock'];
          $this->merek = $row['merek'];
          $this->category = $row['category'];
          $this->harga = $row['harga']; 
          $this->warna = $row['warna']; 
          $this->size = $row['size'];
    }

    public function create() {
      // Create query
      $query = 'INSERT INTO ' . $this->table . ' SET id = :id, nama_barang = :nama_barang, stock = :stock, merek = :merek, category = :category ,harga = :harga, warna = :warna, size = :size';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Clean data
      $this->id = htmlspecialchars(strip_tags($this->id));
      $this->nama_barang = htmlspecialchars(strip_tags($this->nama_barang));
      $this->stock = htmlspecialchars(strip_tags($this->stock));
      $this->merek = htmlspecialchars(strip_tags($this->merek));
      $this->category = htmlspecialchars(strip_tags($this->category));
      $this->harga = htmlspecialchars(strip_tags($this->harga));
      $this->warna = htmlspecialchars(strip_tags($this->warna));
      $this->size = htmlspecialchars(strip_tags($this->size));

      // Bind data
      $stmt->bindParam(':id', $this->id);
      $stmt->bindParam(':nama_barang', $this->nama_barang);
      $stmt->bindParam(':stock', $this->stock);
      $stmt->bindParam(':merek', $this->merek);
      $stmt->bindParam(':category', $this->category);
      $stmt->bindParam(':harga', $this->harga);
      $stmt->bindParam(':warna', $this->warna);
      $stmt->bindParam(':size', $this->size);


      // Execute query
      if($stmt->execute()) {
        return true;
      }

       // Print error if something goes wrong
       printf("Error: %s.\n", $stmt->error);

       return false;
  }
  }