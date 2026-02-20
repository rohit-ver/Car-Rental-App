<?php
include 'includes/dbConnection.php';

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM add_cars WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$car = $result->fetch_assoc();

if(!$car){
    die("Car Not Found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $car['car_name']; ?> - Details</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

body{
    background:linear-gradient(135deg,#1e3c72,#2a5298);
    padding:50px 20px;
}

.container{
    max-width:1200px;
    margin:auto;
    background:#fff;
    border-radius:20px;
    box-shadow:0 20px 50px rgba(0,0,0,0.2);
    overflow:hidden;
    display:flex;
    flex-wrap:wrap;
}

.image-box{
    flex:1 1 50%;
    position:relative;
}

.image-box img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.4s ease;
}

.image-box img:hover{
    transform:scale(1.05);
}

.badge{
    position:absolute;
    top:20px;
    left:20px;
    background:#28a745;
    color:#fff;
    padding:8px 15px;
    border-radius:30px;
    font-size:13px;
    font-weight:bold;
}

.details{
    flex:1 1 50%;
    padding:50px;
}

.details h1{
    font-size:32px;
    margin-bottom:10px;
}

.sub-title{
    color:#777;
    margin-bottom:25px;
}

.price-box{
    background:#f8f9fa;
    padding:20px;
    border-radius:15px;
    margin-bottom:25px;
}

.price{
    font-size:26px;
    color:#2a5298;
    font-weight:bold;
}

.specs{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:15px;
    margin-bottom:25px;
}

.spec-item{
    background:#f1f3f6;
    padding:12px 15px;
    border-radius:10px;
    font-size:14px;
}

.description{
    margin-bottom:30px;
    line-height:1.7;
    color:#555;
}

button{
    padding:15px 30px;
    background:#28a745;
    border:none;
    border-radius:10px;
    color:white;
    font-size:16px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s ease;
}

button:hover{
    background:#1e7e34;
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(0,0,0,0.2);
}

/* Responsive */
@media(max-width:768px){
    .container{
        flex-direction:column;
    }
    .details{
        padding:30px;
    }
    .specs{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="image-box">
        <span class="badge">Available</span>
        <img src="images/uploads/<?php echo $car['image']; ?>" alt="Car Image">
    </div>

    <div class="details">
        <h1><?php echo $car['car_name']; ?></h1>
        <div class="sub-title"><?php echo $car['brand']; ?> • <?php echo $car['car_model']; ?></div>

        <div class="price-box">
            <div class="price">₹ <?php echo $car['self_drive_price']; ?> / Day</div>
        </div>

        <div class="specs">
            <div class="spec-item"><strong>Fuel:</strong> <?php echo $car['fuel_type']; ?></div>
            <div class="spec-item"><strong>Car Number:</strong> <?php echo $car['car_number']; ?></div>
        </div>

        <div class="description">
            <?php echo $car['description']; ?>
        </div>

        <form action="Book_car.php" method="GET">
            <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
            <button type="submit">Book Now</button>
        </form>
    </div>

</div>

</body>
</html>
    