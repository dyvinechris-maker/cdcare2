<?php
session_start();

// Redirect if no account is logged in
if (!isset($_SESSION['user'])) {
    header("Location: sign-up.html");
    exit;
}

$user = $_SESSION['user'];

// --- PHP DATA ARRAY for Car Details ---
$cars = [
    'mustang' => [
        'name' => 'Ford Mustang GT',
        'price' => 750000, // Naira
        'description' => 'A legendary American muscle car, featuring a powerful V8 engine, iconic styling, and superior performance handling.',
        'image' => './Assets/mustang.jpg',
    ],
    'raptor' => [
        'name' => 'Ford F-150 Raptor',
        'price' => 980000,
        'description' => 'The ultimate off-road pickup truck. Equipped with high-performance suspension and an aggressive twin-turbo V6 engine.',
        'image' => './Assets/ford raptor.jpg',
    ],
    'mercedes' => [
        'name' => 'Mercedes-Benz G-Wagon',
        'price' => 550000,
        'description' => 'An iconic luxury SUV combining rugged off-road capability with a prestigious and luxurious interior design.',
        'image' => './Assets/mercedes.jpg',
    ],
    'cybertruck' => [
        'name' => 'Tesla Cybertruck',
        'price' => 620000,
        'description' => 'The futuristic, all-electric pickup truck featuring an ultra-hard stainless steel exoskeleton and massive towing power.',
        'image' => './Assets/cyber 1.jpg',
    ],
    'tesla' => [
        'name' => 'Tesla Model 3',
        'price' => 410000,
        'description' => 'A performance-focused electric sedan known for its minimalist design, high-tech features, and impressive range.',
        'image' => './Assets/tesla.jpg',
    ],
    'old_mustang' => [
        'name' => 'Classic Mustang (1969)',
        'price' => 880000,
        'description' => 'A beautifully restored classic, offering timeless style and the pure driving experience of the muscle car golden age.',
        'image' => './Assets/mustang old.jpg',
    ],
    'chevrolet' => [
        'name' => 'Chevrolet Corvette Z06',
        'price' => 790000,
        'description' => 'A high-performance American sports car with a mid-engine layout, designed for track domination and daily driving.',
        'image' => './Assets/chevrolet.jpg',
    ],
    'ford_gt' => [
        'name' => 'Ford GT Supercar',
        'price' => 950000,
        'description' => 'A rare, limited-production mid-engine sports car, famed for its aerodynamic efficiency and racing heritage.',
        'image' => './Assets/ford.jpg',
    ],
    'bmw_m4' => [
        'name' => 'BMW M4 Competition',
        'price' => 510000,
        'description' => 'A luxury performance coupe offering sharp handling, a powerful inline-six engine, and BMW\'s signature style.',
        'image' => './Assets/bmw1.jpg',
    ],
    'audi_r8' => [
        'name' => 'Audi R8 V10 Plus',
        'price' => 840000,
        'description' => 'A stunning supercar with a naturally aspirated V10 engine, known for its daily drivability and incredible sound.',
        'image' => './Assets/audi.jpg',
    ],
    'bently_gt' => [
        'name' => 'Bentley Continental GT',
        'price' => 990000,
        'description' => 'An ultra-luxury grand tourer combining supreme comfort, exquisite craftsmanship, and immense W12 engine power.',
        'image' => './Assets/bently.jpg',
    ],
    'cupra' => [
        'name' => 'Cupra Formentor VZ5',
        'price' => 320000,
        'description' => 'A sporty and stylish performance crossover from Seat\'s performance brand, featuring aggressive design and all-wheel-drive.',
        'image' => './Assets/cupra.jpg',
    ],
    'maybach' => [
        'name' => 'Mercedes-Maybach S-Class',
        'price' => 810000,
        'description' => 'The pinnacle of sedan luxury, providing unmatched rear-seat comfort, advanced technology, and a commanding presence.',
        'image' => './Assets/maybach.jpg',
    ],
    'mclaren' => [
        'name' => 'McLaren 720S',
        'price' => 770000,
        'description' => 'A high-speed British supercar built around a carbon fiber chassis, known for its incredible power-to-weight ratio.',
        'image' => './Assets/mclaren.jpg',
    ],
    'ferrari' => [
        'name' => 'Ferrari 296 GTB',
        'price' => 910000,
        'description' => 'A revolutionary plug-in hybrid V6 Ferrari, delivering staggering performance and dynamic driving pleasure.',
        'image' => './Assets/ferrari.jpg',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<title>Your Dashboard</title>

<style>
    :root {
        --primary-color: #ff6600; /* Original brand color */
        --secondary-color: #333;
        --background-light: #f9f0e8;
        --background-white: #ffffff;
        --text-dark: #333;
        --text-light: #666;
        --border-color: #ddd;
    }

    /* Reset and Base Styling */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: var(--background-light);
        margin: 0;
        padding-bottom: 80px; 
        color: var(--text-dark);
    }

    /* Search and Content Wrapper Styles */
    .sticky-search { position: sticky; top: 0; z-index: 999; background: var(--background-light); padding: 15px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: center; max-width: 100%; }
    .search-box { width: 50%; max-width: 600px; padding: 15px; border-radius: 8px; border: 1px solid #ccc; font-size: 16px; }
    h2 { text-align: center; padding: 20px 20px 10px 20px; margin-top: 0; }
    .main-wrapper { max-width: 1000px; margin: 0 auto; padding: 0 10px; }
    .slider-container { width: 100%; overflow: hidden; position: relative; }
    
    .slider-wrapper { 
        display: flex; 
        transition: transform 0.4s ease-in-out; 
        width: 100%; 
        will-change: transform; 
        transform: translateZ(0); 
    }
    .page { width: 100%; flex-shrink: 0; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 20px; box-sizing: border-box; }
    
    /* Search Result Display */
    #search-results-container {
        display: none; 
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        padding: 20px;
    }
    
    /* Card Styles */
    .card {
        background: var(--background-white);
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        text-align: center;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .card:hover { transform: translateY(-3px); box-shadow: 0 5px 15px rgba(0,0,0,0.15); }
    .card img { width: 100%; aspect-ratio: 1 / 1; object-fit: cover; border-radius: 10px; }
    .car-price { margin: 10px 0 5px 0; font-weight: bold; color: #008000; font-size: 1.2em; }
    .card-title { margin: 0; font-weight: bold; font-size: 1em; }
    .card-desc { font-size: 12px; color: #555; height: 36px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }

    /* Pagination */
    .pagination { display: flex; justify-content: center; gap: 10px; padding: 20px 0; margin-bottom: 20px; }
    .pagination button { padding: 10px 15px; border: none; background: #ddd; border-radius: 5px; cursor: pointer; font-weight: bold; transition: background 0.3s, color 0.3s; }
    .pagination button.active { background: var(--primary-color); color: var(--background-white); }

    /* Modal Styles (Crucial for Scrolling) */
    .modal-overlay { 
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
        background: rgba(0, 0, 0, 0.7); display: none; justify-content: center; 
        align-items: center; z-index: 2000; backdrop-filter: blur(5px); 
        padding: 20px; 
    }
    .modal-content { 
        background: var(--background-white); padding: 30px; 
        border-radius: 15px; width: 90%; max-width: 600px; 
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); position: relative; 
        animation: fadeIn 0.3s ease-out; 
        
        max-height: 95vh; 
        overflow-y: auto; 
    }
    @keyframes fadeIn { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    .modal-close { position: absolute; top: 10px; right: 15px; font-size: 24px; font-weight: bold; cursor: pointer; color: #333; }
    .modal-image { width: 100%; max-height: 250px; object-fit: cover; border-radius: 8px; margin-bottom: 15px; }
    .modal-details h3 { margin-top: 0; color: var(--primary-color); font-size: 1.8em; }
    .modal-details p { font-size: 1em; line-height: 1.5; color: #444; }
    .modal-details strong { font-size: 1.3em; color: #008000; }
    .installment-options { margin-top: 20px; padding-top: 15px; border-top: 1px solid #eee; }
    
    /* --- Styles for Installment Options --- */
    .frequency-group, .installments-grid, .insurance-options {
        margin-bottom: 20px;
    }

    .frequency-group .option-btn, .installments-grid .option-btn, .insurance-options .option-btn {
        padding: 10px 15px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        background-color: var(--background-white);
        cursor: pointer;
        font-size: 14px;
        font-weight: normal;
        transition: background-color 0.2s, border-color 0.2s;
        text-align: center;
    }

    .frequency-group {
        display: flex;
        gap: 10px;
        margin-top: 5px;
    }

    .frequency-group .option-btn {
        flex: 1;
    }

    .installments-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .installments-grid .option-btn {
        min-width: 50px;
        flex-grow: 1;
        flex-basis: calc(14.28% - 8px); 
    }

    /* Active/Selected Button Style */
    .option-btn.active {
        background-color: var(--primary-color);
        color: var(--background-white);
        border-color: var(--primary-color);
        font-weight: bold;
    }
    
    /* --- CRUCIAL CHANGE: Makes elements completely disappear --- */
    .option-btn.hidden {
        display: none !important; 
    }
    /* -------------------------------------------------------- */

    /* Payment Success Button */
    #pay-now-btn {
        display: block;
        width: 100%;
        padding: 15px;
        margin-top: 25px;
        background-color: #008000; 
        color: var(--background-white);
        border: none;
        border-radius: 8px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    #pay-now-btn:hover {
        background-color: #006400;
    }

    /* Success Message Modal */
    .success-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 3000;
        backdrop-filter: blur(5px);
    }

    .success-modal-content {
        background: var(--background-white);
        padding: 40px;
        border-radius: 15px;
        text-align: center;
        width: 90%;
        max-width: 400px;
    }
    .success-modal-content i {
        color: #008000;
        font-size: 4em;
        margin-bottom: 20px;
    }
    .success-modal-content h3 {
        color: #008000;
        margin-top: 0;
    }
    
    #installment-result { 
        padding: 10px; 
        background: #e6f7ff; 
        border: 1px solid #b3e0ff; 
        border-radius: 5px; 
        font-weight: bold; 
        color: #0056b3; 
        text-align: center; 
        margin-top: 15px;
    }

    /* --- BOTTOM NAV STYLES --- */
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: var(--background-white);
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: space-around;
        padding: 5px 0;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        z-index: 100;
    }

    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        font-size: 12px;
        color: var(--text-light);
        text-decoration: none;
        flex: 1;
        padding: 8px 0;
        transition: color 0.2s;
    }

    .nav-item i {
        font-size: 20px; 
        margin-bottom: 4px;
    }

    .nav-item:hover {
        color: var(--secondary-color);
    }

    .nav-item.active {
        color: var(--primary-color);
        font-weight: bold;
    }
</style>
</head>

<body>

<div class="sticky-search">
    <input id="search-input" class="search-box" type="text" placeholder="Search for car name..." onkeyup="filterCars()" />
</div>

<div class="main-wrapper">

    <h2>Featured Products</h2>

    <div id="search-results-container">
        <p id="no-results-message" style="grid-column: 1 / span 3; text-align: center; font-style: italic; display: none;">No cars found matching your search.</p>
    </div>

    <div id="slider-main-container" class="slider-container">
        <div class="slider-wrapper" id="slider-wrapper">

            <div class="page">
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['mustang'])); ?>'>
                    <img src="<?php echo $cars['mustang']['image']; ?>" alt="Mustang">
                    <p class="card-title"><?php echo $cars['mustang']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['mustang']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['mustang']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['raptor'])); ?>'>
                    <img src="<?php echo $cars['raptor']['image']; ?>" alt="Ford Raptor">
                    <p class="card-title"><?php echo $cars['raptor']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['raptor']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['raptor']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['mercedes'])); ?>'>
                    <img src="<?php echo $cars['mercedes']['image']; ?>" alt="Mercedes G-Wagon">
                    <p class="card-title"><?php echo $cars['mercedes']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['mercedes']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['mercedes']['price']); ?></p>
                </div>
            </div>

            <div class="page">
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['cybertruck'])); ?>'>
                    <img src="<?php echo $cars['cybertruck']['image']; ?>" alt="Cybertruck">
                    <p class="card-title"><?php echo $cars['cybertruck']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['cybertruck']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['cybertruck']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['tesla'])); ?>'>
                    <img src="<?php echo $cars['tesla']['image']; ?>" alt="Tesla Model 3">
                    <p class="card-title"><?php echo $cars['tesla']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['tesla']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['tesla']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['old_mustang'])); ?>'>
                    <img src="<?php echo $cars['old_mustang']['image']; ?>" alt="Classic Mustang">
                    <p class="card-title"><?php echo $cars['old_mustang']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['old_mustang']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['old_mustang']['price']); ?></p>
                </div>
            </div>

            <div class="page">
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['chevrolet'])); ?>'>
                    <img src="<?php echo $cars['chevrolet']['image']; ?>" alt="Chevrolet Corvette Z06">
                    <p class="card-title"><?php echo $cars['chevrolet']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['chevrolet']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['chevrolet']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['ford_gt'])); ?>'>
                    <img src="<?php echo $cars['ford_gt']['image']; ?>" alt="Ford GT Supercar">
                    <p class="card-title"><?php echo $cars['ford_gt']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['ford_gt']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['ford_gt']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['bmw_m4'])); ?>'>
                    <img src="<?php echo $cars['bmw_m4']['image']; ?>" alt="BMW M4 Competition">
                    <p class="card-title"><?php echo $cars['bmw_m4']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['bmw_m4']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['bmw_m4']['price']); ?></p>
                </div>
            </div>
            
            <div class="page">
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['audi_r8'])); ?>'>
                    <img src="<?php echo $cars['audi_r8']['image']; ?>" alt="Audi R8 V10 Plus">
                    <p class="card-title"><?php echo $cars['audi_r8']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['audi_r8']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['audi_r8']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['bently_gt'])); ?>'>
                    <img src="<?php echo $cars['bently_gt']['image']; ?>" alt="Bentley Continental GT">
                    <p class="card-title"><?php echo $cars['bently_gt']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['bently_gt']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['bently_gt']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['cupra'])); ?>'>
                    <img src="<?php echo $cars['cupra']['image']; ?>" alt="Cupra Formentor VZ5">
                    <p class="card-title"><?php echo $cars['cupra']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['cupra']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['cupra']['price']); ?></p>
                </div>
            </div>

            <div class="page">
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['maybach'])); ?>'>
                    <img src="<?php echo $cars['maybach']['image']; ?>" alt="Mercedes-Maybach S-Class">
                    <p class="card-title"><?php echo $cars['maybach']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['maybach']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['maybach']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['mclaren'])); ?>'>
                    <img src="<?php echo $cars['mclaren']['image']; ?>" alt="McLaren 720S">
                    <p class="card-title"><?php echo $cars['mclaren']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['mclaren']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['mclaren']['price']); ?></p>
                </div>
                <div class="card" onclick="showDetails(this)" data-car='<?php echo htmlspecialchars(json_encode($cars['ferrari'])); ?>'>
                    <img src="<?php echo $cars['ferrari']['image']; ?>" alt="Ferrari 296 GTB">
                    <p class="card-title"><?php echo $cars['ferrari']['name']; ?></p>
                    <span class="card-desc"><?php echo $cars['ferrari']['description']; ?></span>
                    <p class="car-price">₦<?php echo number_format($cars['ferrari']['price']); ?></p>
                </div>
            </div>

        </div>
    </div>

    <div id="pagination-main" class="pagination">
        <button class="active" onclick="showPage(1)">1</button>
        <button onclick="showPage(2)">2</button>
        <button onclick="showPage(3)">3</button>
        <button onclick="showPage(4)">4</button>
        <button onclick="showPage(5)">5</button>
    </div>

</div> 
<script>
// Global car data accessible by JavaScript
const allCarsData = <?php echo json_encode($cars); ?>;
let currentCarData = {};
let selectedFrequency = 'W'; // Default to Weekly
let selectedInstallments = 4; // Default weekly installment option

/**
 * Helper function to create a card element from car data.
 */
function createCarCard(carKey, car) {
    return `
        <div class="card" onclick="showDetails(this)" data-car='${JSON.stringify(car)}'>
            <img src="${car.image}" alt="${car.name}">
            <p class="card-title">${car.name}</p>
            <span class="card-desc">${car.description}</span>
            <p class="car-price">₦${car.price.toLocaleString()}</p>
        </div>
    `;
}

/**
 * Function to handle car searching and display results.
 */
function filterCars() {
    const searchTerm = document.getElementById('search-input').value.toLowerCase().trim();
    const sliderContainer = document.getElementById('slider-main-container');
    const searchResultsContainer = document.getElementById('search-results-container');
    const pagination = document.getElementById('pagination-main');
    const noResults = document.getElementById('no-results-message');
    
    if (searchTerm === '') {
        // If search term is empty, show slider and hide search results
        sliderContainer.style.display = 'block';
        pagination.style.display = 'flex';
        searchResultsContainer.style.display = 'none';
        return;
    }

    // Hide slider and show search results container
    sliderContainer.style.display = 'none';
    pagination.style.display = 'none';
    searchResultsContainer.style.display = 'grid'; 
    searchResultsContainer.innerHTML = ''; 

    let foundResults = 0;
    let resultsHtml = '';

    for (const key in allCarsData) {
        const car = allCarsData[key];
        if (car.name.toLowerCase().includes(searchTerm)) {
            resultsHtml += createCarCard(key, car);
            foundResults++;
        }
    }

    if (foundResults > 0) {
        searchResultsContainer.innerHTML = resultsHtml;
        noResults.style.display = 'none';
    } else {
        searchResultsContainer.style.display = 'block'; 
        searchResultsContainer.innerHTML = ''; 
        noResults.style.display = 'block'; 
        searchResultsContainer.appendChild(noResults);
    }
}

/**
 * Slider function remains the same.
 */
function showPage(pageNumber) {
    const sliderWrapper = document.getElementById("slider-wrapper");
    const totalPages = 5;

    if (pageNumber < 1 || pageNumber > totalPages) {
        console.error("Invalid page number.");
        return;
    }

    const translateValue = -100 * (pageNumber - 1);
    sliderWrapper.style.transform = `translateX(${translateValue}%)`;

    document.querySelectorAll(".pagination button").forEach(btn => {
        btn.classList.remove("active");
    });
    
    const activeButton = document.querySelectorAll(".pagination button")[pageNumber - 1];
    if (activeButton) {
        activeButton.classList.add("active");
    }
}


/**
 * Function to display the modal with comprehensive car and payment details.
 */
function showDetails(cardElement) {
    const carData = JSON.parse(cardElement.getAttribute('data-car'));
    currentCarData = carData; 

    document.getElementById('modal-img').src = carData.image;
    document.getElementById('modal-img').alt = carData.name;
    document.getElementById('modal-title').textContent = carData.name;
    document.getElementById('modal-full-desc').textContent = carData.description;
    document.getElementById('modal-price').textContent = `₦${carData.price.toLocaleString()}`;

    document.getElementById('product-modal').style.display = 'flex'; 
    
    // Reset to default selection and calculate
    resetInstallmentSelection('W');
    calculateInstallment();
}

/**
 * Function to hide the modal.
 */
function hideDetails() {
    document.getElementById('product-modal').style.display = 'none';
}

/**
 * Reset and apply initial selection state - UPDATED LOGIC HERE
 */
function resetInstallmentSelection(frequency) {
    const installmentBtns = document.querySelectorAll('#installments-selector .option-btn');
    let firstActiveSet = false;
    
    // 1. Clear active state for frequency buttons and set new active state
    document.querySelectorAll('#frequency-selector .option-btn').forEach(btn => {
        if (btn.dataset.frequency === frequency) {
            btn.classList.add('active');
            selectedFrequency = frequency; // Set global frequency
        } else {
            btn.classList.remove('active');
        }
    });

    // 2. Control visibility and set active state for installment buttons
    installmentBtns.forEach(btn => {
        if (btn.dataset.frequencyRef === frequency) {
            btn.classList.remove('hidden'); // Show relevant options
            
            // Set the first available installment as active by default for the new frequency
            if (!firstActiveSet) {
                btn.classList.add('active');
                selectedInstallments = parseInt(btn.dataset.installments);
                firstActiveSet = true;
            } else {
                btn.classList.remove('active'); // Ensure only the first one is active
            }
        } else {
            btn.classList.add('hidden'); // Hide irrelevant options
            btn.classList.remove('active'); // Also remove active state
        }
    });
}

/**
 * Function to calculate installment based on selected options.
 */
function calculateInstallment() {
    const resultElement = document.getElementById('installment-result');
    
    if (!currentCarData || !currentCarData.price) {
        resultElement.textContent = "Error: Price not available.";
        return;
    }

    const totalPrice = currentCarData.price;
    const frequency = selectedFrequency;
    const periods = selectedInstallments; 

    const annualInterestRate = 0.05; // 5% Simple Interest Rate
    
    // Calculate duration in years based on frequency
    const totalDurationInYears = periods / (frequency === 'M' ? 12 : 52); 
    
    const totalInterest = totalPrice * (annualInterestRate * totalDurationInYears);
    const totalPayable = totalPrice + totalInterest;
    
    const installmentAmount = totalPayable / periods;

    const installmentLabel = frequency === 'M' ? 'Monthly' : 'Weekly';
    
    resultElement.innerHTML = `
        Total Payable: <strong>₦${totalPayable.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</strong><br>
        Your ${installmentLabel} Installment: <strong>₦${installmentAmount.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})}</strong> (for ${periods} payments)
    `;
}

/**
 * Event Listeners and Initialization
 */
document.addEventListener('DOMContentLoaded', (event) => {
    showPage(1);

    // 1. Installment Frequency Selector (Weekly/Monthly)
    document.getElementById('frequency-selector').addEventListener('click', function(e) {
        const btn = e.target.closest('.option-btn');
        if (!btn) return;

        resetInstallmentSelection(btn.dataset.frequency);
        calculateInstallment();
    });

    // 2. Installment Number Selector
    document.getElementById('installments-selector').addEventListener('click', function(e) {
        const btn = e.target.closest('.option-btn');
        if (!btn || btn.classList.contains('hidden')) return;

        // Clear active state for all visible installment buttons
        document.querySelectorAll(`#installments-selector .option-btn:not(.hidden)`).forEach(b => b.classList.remove('active'));
        
        btn.classList.add('active');
        selectedInstallments = parseInt(btn.dataset.installments);
        calculateInstallment();
    });

    // 3. Payment Button Logic
    document.getElementById('pay-now-btn').addEventListener('click', function() {
        hideDetails();
        document.getElementById('success-modal').style.display = 'flex';
    });

    // Initialize the slider and default installment selection
    // NOTE: This call will run the new logic, hiding monthly options initially.
    resetInstallmentSelection('W'); 
});
</script>


<div class="bottom-nav">
    <a href="dashboard.php" class="nav-item active">
        <i class="fas fa-store"></i> Shop
    </a>
    <a href="cart.php" class="nav-item">
        <i class="fas fa-shopping-cart"></i> Cart
    </a>
    <a href="history.php" class="nav-item">
        <i class="fas fa-history"></i> History
    </a>
    <a href="wishlist.php" class="nav-item">
        <i class="fas fa-heart"></i> Wishlist
    </a>
    <a href="account.php" class="nav-item">
        <i class="fas fa-user"></i> Account
    </a>
</div>
<div id="product-modal" class="modal-overlay">
    <div class="modal-content">
        <span class="modal-close" onclick="hideDetails()">&times;</span>
        
        <img id="modal-img" class="modal-image" src="" alt="Car Detail">
        
        <div class="modal-details">
            <h3 id="modal-title">Car Model Name</h3>
            <p>Full Price: <strong id="modal-price"></strong></p>
            <p id="modal-full-desc">This is the comprehensive description of the car, detailing its features, engine type, mileage, and color options.</p>
        </div>

        <div class="installment-options">
            <h4>Payment Options (Simple Interest Included)</h4>
            
            <p>Select payment frequency to pay small.</p>
            <div id="frequency-selector" class="frequency-group">
                <button class="option-btn active" data-frequency="W">Weekly</button>
                <button class="option-btn" data-frequency="M">Monthly</button>
            </div>

            <p>Select the number of installments</p>
            <div id="installments-selector" class="installments-grid">
                <button class="option-btn" data-installments="4" data-frequency-ref="W">4</button>
                <button class="option-btn" data-installments="6" data-frequency-ref="W">6</button>
                <button class="option-btn" data-installments="8" data-frequency-ref="W">8</button>
                <button class="option-btn" data-installments="10" data-frequency-ref="W">10</button>
                <button class="option-btn" data-installments="12" data-frequency-ref="W">12</button>
                <button class="option-btn" data-installments="14" data-frequency-ref="W">14</button>
                <button class="option-btn" data-installments="16" data-frequency-ref="W">16</button>
                <button class="option-btn" data-installments="18" data-frequency-ref="W">18</button>
                <button class="option-btn" data-installments="20" data-frequency-ref="W">20</button>
                <button class="option-btn" data-installments="22" data-frequency-ref="W">22</button>
                <button class="option-btn" data-installments="24" data-frequency-ref="W">24</button>
                <button class="option-btn" data-installments="26" data-frequency-ref="W">26</button>
                
                <button class="option-btn hidden" data-installments="2" data-frequency-ref="M">2</button>
                <button class="option-btn hidden" data-installments="4" data-frequency-ref="M">4</button>
                <button class="option-btn hidden" data-installments="6" data-frequency-ref="M">6</button>
                <button class="option-btn hidden" data-installments="8" data-frequency-ref="M">8</button>
                <button class="option-btn hidden" data-installments="10" data-frequency-ref="M">10</button>
                <button class="option-btn hidden" data-installments="12" data-frequency-ref="M">12</button>
            </div>
            
            <div id="installment-result">
                Select your installment plan to see the payment breakdown.
            </div>
            
            <button id="pay-now-btn">Pay Now!</button>

        </div>
    </div>
</div>

<div id="success-modal" class="success-modal-overlay">
    <div class="success-modal-content">
        <i class="fas fa-check-circle"></i>
        <h3>Payment Successful!</h3>
        <p>Your installment plan has been successfully processed.</p>
        <button class="action-btn primary" onclick="document.getElementById('success-modal').style.display='none'; hideDetails();">Close</button>
    </div>
</div>
</body>
</html>