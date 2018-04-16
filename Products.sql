-- CREATE TABLE `products`(`productID` int, `quantity` int, `name` text, `description` text,`location` text);
-- 	INSERT INTO `products`(`productID`, `quantity`, `name`, `description` `location`)
-- 	VALUES
-- 	(1,10,'Cowboy hat close up','Close up',)
CREATE TABLE `products`(`productID` int NOT NULL AUTO_INCREMENT, `name` text, `description` text,  `location` text, `price` float, PRIMARY KEY(`productID`));


INSERT INTO `products`(`name`, `description`, `location`, `price`)
VALUES
	('Red bag','Red bag which is perfect for carrying things','Images/bag.jpg', 9.99),
	('Leather Belt','Leather belt','Images/belt1.jpg', 14.99),
	('Leather Belt','Leather belt','Images/belt2.jpg', 14.99),
	('Black Shirt','Black Shirt','Images/combinedImage.jpg', 7.99),
	('Blue Jacket','Blue Jacket','Images/blueJacket.jpg', 7.99),
	('Blue Shirt','Blue Shirt','Images/blueShirt.jpg', 7.99),
	('Blue Cap','Blue Cap','Images/cap1.jpg', 7.99),
	('Cowboy hat','Cowboy Hat','Images/cowboyHatIsolated.jpg', 7.99),
	('Gray Shirt','Gray Shirt','Images/grayShirt.jpg', 7.99),
	('Green Jacket','Green Jacket','Images/greenJacket.jpg', 19.99),
	('Leather hat','Leather Hat','Images/leatherCowboyHat.jpg', 19.99),
	('Silver Mug','Silver Mug','Images/mug1.jpg', 3.99),
	('Orange Mug','Orange Mug','Images/mug2.jpg', 3.99),
	('Orange Shirt','Orange Shirt','Images/orangeShirt.jpg',7.99),
	('Red Shirt','Red Shirt','Images/redShirt.jpg', 7.99),
	('Black Wallet','Black Wallet','Images/wallet1.jpg', 9.99),
	('Brown Wallet','Brown Wallet','Images/wallet2.jpg',9.99),
	('Gray Wallet','Gray Wallet','Images/wallet3.jpg', 9.99),
	('White Shirt','White Shirt','Images/whiteShirt.jpg',7.99);

	CREATE TABLE `cart`(`productID` int, `quantity` int, `customerID` int);

	CREATE TABLE `customer`(`customerID` int  NOT NULL AUTO_INCREMENT, `name` text, `address` text, `dob` text, `gender` text, `username` text, `password` text, PRIMARY KEY (`customerID`));

	CREATE TABLE `admin`(`adminID` int NOT NULL AUTO_INCREMENT, `name` text, `username` text, `password` text, PRIMARY KEY (`adminID`));

	CREATE TABLE `order` (`orderID` int  NOT NULL AUTO_INCREMENT, `customerID` int, `totalPrice` float, created_date TIMESTAMP DEFAULT NOW(), PRIMARY KEY (`orderID`));

	CREATE TABLE `orderItems`(`orderID` int , `productID` int, `quantity` int, `price` float);
