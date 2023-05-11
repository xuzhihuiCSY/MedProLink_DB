<?php
// establish a connection to the database
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

// check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// create a new database
$sql = "CREATE DATABASE hw3_DB";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

mysqli_select_db($conn, "hw3_DB");
// create the Sailors table
$sql = "CREATE TABLE Sailors (
    sid INT PRIMARY KEY,
    sname VARCHAR(255),
    rating INT,
    age FLOAT
)";
if (mysqli_query($conn, $sql)) {
echo "Sailors table created successfully<br>";
} else {
echo "Error creating Sailors table: " . mysqli_error($conn);
}

// insert data into the Sailors table
$sql = "INSERT INTO Sailors (sid, sname, rating, age) VALUES
    (22, 'Dustion', 7, 45),
    (29, 'Brutus', 1, 33),
    (31, 'Lubber', 8, 55.5),
    (32, 'Andy', 8, 25.5),
    (58, 'Rusty', 10, 35),
    (64, 'Horatio', 9, 35),
    (85, 'Art', 3, 25.5),
    (95, 'Bob', 3, 63.5)";
if (mysqli_query($conn, $sql)) {
echo "Data inserted into Sailors table successfully<br>";
} else {
echo "Error inserting data into Sailors table: " . mysqli_error($conn);
}

// create the Boats table
$sql = "CREATE TABLE Boats (
    bid INT PRIMARY KEY,
    bname VARCHAR(255),
    color VARCHAR(255)
)";
if (mysqli_query($conn, $sql)) {
echo "Boats table created successfully<br>";
} else {
echo "Error creating Boats table: " . mysqli_error($conn);
}

// insert data into the Boats table
$sql = "INSERT INTO Boats (bid, bname, color) VALUES
    (101, 'Interlake', 'blue'),
    (102, 'Interlake', 'red'),
    (103, 'Clipper', 'green'),
    (104, 'Marine', 'red')";
if (mysqli_query($conn, $sql)) {
echo "Data inserted into Boats table successfully<br>";
} else {
echo "Error inserting data into Boats table: " . mysqli_error($conn);
}

// create the Reserves table
$sql = "CREATE TABLE Reserves (
    sid INT,
    bid INT,
    day DATE,
    PRIMARY KEY (sid, bid, day),
    FOREIGN KEY (sid) REFERENCES Sailors(sid),
    FOREIGN KEY (bid) REFERENCES Boats(bid)
)";
if (mysqli_query($conn, $sql)) {
echo "Reserves table created successfully<br>";
} else {
echo "Error creating Reserves table: " . mysqli_error($conn);
}

// insert data into the Reserves table
$sql = "INSERT INTO Reserves (sid, bid, day) VALUES
    (22, 101, '1998-10-10'),
    (22, 102, '1998-10-10'),
    (22, 103, '1998-10-08'),
    (22, 104, '1998-10-07'),
    (31, 102, '1998-11-10'),
    (31, 103, '1998-11-06'),
    (31, 104, '1998-11-12'),
    (64, 101, '1998-09-05'),
    (64, 102, '1998-09-08'),
    (64, 103, '1998-09-08')";

if (mysqli_query($conn, $sql)) {
    echo "Data inserted into Reserves table successfully";
} else {
    echo "Error inserting data into Reserves table: " . mysqli_error($conn);
}


// query 1
$sql = "SELECT DISTINCT Sailors.sname
        FROM Sailors
        JOIN Reserves ON Sailors.sid = Reserves.sid
        JOIN Boats ON Reserves.bid = Boats.bid
        WHERE Boats.color IN ('red', 'green')";
$result = mysqli_query($conn, $sql);

// print the result of query 1
echo "Query 1: Sailors who reserved a boat with color red or green:<br>";
while ($row = mysqli_fetch_assoc($result)) {
    echo $row["sname"] . "<br>";
}

// query 2
$sql = "SELECT Sailors.sname
        FROM Sailors
        JOIN Reserves ON Sailors.sid = Reserves.sid
        JOIN Boats ON Reserves.bid = Boats.bid
        WHERE Boats.color = 'red' AND Sailors.sid IN (
            SELECT Reserves.sid
            FROM Reserves
            JOIN Boats ON Reserves.bid = Boats.bid
            WHERE Boats.color = 'green'
        )";
$result = mysqli_query($conn, $sql);

// print the result of query 2
echo "<br>Query 2: Sailors who reserved a boat with color red and also reserved a boat with color green:<br>";
while ($row = mysqli_fetch_assoc($result)) {
    echo $row["sname"] . "<br>";
}

// query 3
$sql = "SELECT Sailors.sname
        FROM Sailors
        JOIN Reserves ON Sailors.sid = Reserves.sid
        WHERE Reserves.bid = 103";
$result = mysqli_query($conn, $sql);

// print the result of query 3
echo "<br>Query 3: Sailors who reserved a boat with bid 103:<br>";
while ($row = mysqli_fetch_assoc($result)) {
    echo $row["sname"] . "<br>";
}

// query 4
$sql = "SELECT sname
        FROM Sailors
        WHERE rating = (SELECT MAX(rating) FROM Sailors)";
$result = mysqli_query($conn, $sql);

// print the result of query 4
echo "<br>Query 4: Sailor(s) with the highest rating:<br>";
while ($row = mysqli_fetch_assoc($result)) {
    echo $row["sname"] . "<br>";
}

// query 5
$sql = "SELECT Sailors.sname 
        FROM Sailors 
        WHERE NOT EXISTS (
           SELECT Boats.bid 
           FROM Boats 
           WHERE NOT EXISTS (
              SELECT Reserves.bid 
              FROM Reserves 
              WHERE Reserves.bid = Boats.bid AND Reserves.sid = Sailors.sid
           )
        )";
$result = mysqli_query($conn, $sql);

// print the result of query 5
echo "<br>Query 5: Sailors who reserved all boats:<br>";
while ($row = mysqli_fetch_assoc($result)) {
    echo $row["sname"] . "<br>";
}

// query 6
$sql = "SELECT sname, age
    FROM Sailors
    WHERE age = (
    SELECT MAX(age)
    FROM Sailors
    )";
    $result = mysqli_query($conn, $sql);

    // print the result of query 6
    echo "<br>Query 6: Sailor(s) with the maximum age:<br>";
    while ($row = mysqli_fetch_assoc($result)) {
    echo $row["sname"] . ", " . $row["age"] . "<br>";
    }

    // query 7
$sql = "SELECT rating, AVG(age) AS avg_age
    FROM Sailors
    GROUP BY rating
    HAVING COUNT(*) >= 2";
    $result = mysqli_query($conn, $sql);

    // print the result of query 7
    echo "<br>Query 7: Average age of sailors with at least two sailors having the same rating:<br>";
    while ($row = mysqli_fetch_assoc($result)) {
    echo "Rating: " . $row["rating"] . ", Average Age: " . $row["avg_age"] . "<br>";
    }

    // query 8
$sql = "SELECT Boats.bid, Boats.bname, COUNT(*) as num_reservations
    FROM Boats
    JOIN Reserves ON Boats.bid = Reserves.bid
    WHERE Boats.color = 'red'
    GROUP BY Boats.bid, Boats.bname";
    $result = mysqli_query($conn, $sql);

    // print the result of query 8
    echo "<br>Query 8: Number of reservations for red boats:<br>";
    while ($row = mysqli_fetch_assoc($result)) {
    echo "Boat ID: " . $row["bid"] . ", Boat Name: " . $row["bname"] . ", Number of Reservations: " . $row["num_reservations"] . "<br>";
    }

    // close the database connection
    mysqli_close($conn);
    ?>