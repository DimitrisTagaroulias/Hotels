-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 04:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `total_price`, `created_time`, `updated_time`) VALUES
(1, 141, 1, '2022-10-01', '2022-10-31', 2500, '2022-09-29 08:59:45', '2022-09-29 08:59:45'),
(2, 141, 4, '2022-10-10', '2022-10-20', 5000, '2022-09-29 16:16:46', '2022-09-29 16:16:46'),
(3, 141, 7, '2022-11-09', '2022-11-26', 1500, '2022-09-29 16:17:14', '2022-09-29 16:17:14'),
(103, 141, 1, '2022-12-26', '2022-12-27', 350, '2022-10-24 17:27:04', '2022-10-24 17:27:04'),
(104, 141, 4, '2022-10-31', '2022-11-26', 6500, '2022-10-31 11:38:17', '2022-10-31 11:38:17');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`user_id`, `room_id`, `created_time`, `updated_time`) VALUES
(141, 1, '2022-10-19 12:02:11', '2022-10-19 12:02:11'),
(141, 4, '2023-02-24 19:57:35', '2023-02-24 19:57:35'),
(141, 6, '2022-09-29 16:39:05', '2022-09-29 16:39:05'),
(141, 7, '2023-02-22 19:29:49', '2023-02-22 19:29:49'),
(141, 8, '2022-09-29 16:39:10', '2022-09-29 16:39:10'),
(141, 10, '2022-09-29 16:39:16', '2022-09-29 16:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `room_id`, `user_id`, `rate`, `comment`, `created_time`, `updated_time`) VALUES
(12, 7, 141, 4, 'Very good!!!', '2022-09-29 17:24:55', '2022-09-29 17:24:55'),
(92, 1, 141, 4, 'Kalo!', '2022-10-13 15:04:10', '2022-10-13 15:04:10'),
(93, 2, 141, 5, 'Aristo', '2022-10-13 15:25:36', '2022-10-13 15:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `map_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `count_of_guests` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `location_lat` decimal(10,7) NOT NULL,
  `location_long` decimal(10,7) NOT NULL,
  `description_short` varchar(350) COLLATE utf8_unicode_ci NOT NULL,
  `description_long` text COLLATE utf8_unicode_ci NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `wifi` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `pet_friendly` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `avg_reviews` decimal(10,7) DEFAULT NULL,
  `count_reviews` int(10) UNSIGNED DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `type_id`, `name`, `city`, `area`, `photo_url`, `map_url`, `count_of_guests`, `price`, `address`, `location_lat`, `location_long`, `description_short`, `description_long`, `parking`, `wifi`, `pet_friendly`, `avg_reviews`, `count_reviews`, `created_time`, `updated_time`) VALUES
(1, 1, 'Hilton Hotel', 'Athens', 'Zografou', 'room-1.jpg', 'https://maps.google.com/maps?q=%CE%92%CE%B1%CF%83.%20%CE%A3%CE%BF%CF%86%CE%AF%CE%B1%CF%82%2046,%20%CE%91%CE%B8%CE%AE%CE%BD%CE%B1%20115%2028&t=&z=15&ie=UTF8&iwloc=&output=embed', 1, 350, 'Vasilis Sofeias 38', '37.9767030', '23.7504170', 'Located in the heart of Athens, Hilton Athens offers elegant rooms, 3 swimming pools, 4 restaurants and the popular rooftop Galaxy Bar. Evangelismos metro station is just a few steps away and provides access to Syntagma Square in 5 minutes.', 'Located in the heart of Athens, Hilton Athens offers elegant rooms, 3 swimming pools, 4 restaurants and the popular rooftop Galaxy Bar. Evangelismos metro station is just a few steps away and provides access to Syntagma Square in 5 minutes.\nThe luxurious hotel has spacious rooms and suites that have a marble bathroom with a shower cabin and a bathtub. You\'ll also find an LCD TV with cable/satellite channels and a desk with adjustable lighting. Units include patio doors and a balcony with views of the Athenian landscape or the Acropolis.\nServing gourmet Greek cuisine and fresh fish, Milos Restaurant is a favorite choice of the city\'s big names. At the Byzantino restaurant you can enjoy a Mediterranean buffet or à la carte menu, as well as the richest Sunday brunch in Athens. Executive room guests have access to the Executive Lounge on the 11th floor, where complimentary breakfast and various refreshments are served.\nAt the elegant rooftop Galaxy Bar you can try unique cocktails on its outdoor terrace overlooking the Acropolis. Oasis Pool Bar Grill offers Mediterranean dishes and snacks.\nThe Hilton Athens is located in the commercial area of ​​the city, just 500m. from the National Gallery, the Athens Concert Hall and the shops of Kolonaki. The Acropolis is 4 km. away, while the historic area of ​​Plaka is 2.5 km away. from the hotel.', 1, 'Yes', 'No', '4.5000000', 2, '2020-05-28 20:15:36', '2023-03-05 14:45:20'),
(2, 2, 'Megali Vretania Hotel', 'Athens', 'Syntagma', 'room-2.jpg', 'https://maps.google.com/maps?q=1%20Vasileos%20Georgiou%20A,%20Syntagma%20Square%20Str,%20%CE%91%CE%B8%CE%AE%CE%BD%CE%B1%20105%2064&t=&z=13&ie=UTF8&iwloc=&output=embed', 2, 500, 'Vasilis Olgas, 115', '37.9765250', '23.7353970', 'With breathtaking views of the fabled Acropolis, regal Syntagma Square and the Parliament, lush Lycabettus Hill or the original Olympic Stadium, our multi-awarded 5-star Hotel Grande Bretagne offers an unrivaled perspective of Athens\' mythical history.', 'With breathtaking views of the fabled Acropolis, regal Syntagma Square and the Parliament, lush Lycabettus Hill or the original Olympic Stadium, our multi-awarded 5-star Hotel Grande Bretagne offers an unrivaled perspective of Athens\' mythical history. Located right in the heart of the city since 1874, our multi-awarded landmark luxury hotel is within walking distance of exclusive shopping areas, museums and the business district. With meticulous attention to detail, the 320 rooms and suites marry charming old-world elegance with state-of-the-art facilities, whereas the 58 suites enjoy additional benefits including personalized Butler Service. Visit the picturesque GB Roof Garden Restaurant for the finest Mediterranean cuisine or the Winter Garden for an afternoon tea and do not miss the GB Spa for a signature massage, beauty treatment or an indulgent respite in the thermal Suite. Meet our Concierge team members, who stand ready to unlock the secret treasures of Athens.', 1, 'Yes', 'No', '3.4444000', 9, '2020-05-28 20:15:36', '2023-03-05 14:53:17'),
(3, 3, 'Apollo Hotel', 'Athens', 'City Center', 'room-3.jpg', 'https://maps.google.com/maps?q=Apollo%20Hotel%20athens&t=&z=13&ie=UTF8&iwloc=&output=embed', 3, 420, 'Achilleos 10', '37.9853780', '23.7199320', 'The Apollo is a superior 3 star first class central hotel which displays the true values of Greek Hospitality.\nIt is located in Karaiskaki sq. 10, Ahilleos str, 2 min. walk from Meraxourgio Metro Station allowing for easy Rail and Bus access, with convenient reach to Plaka and Acropolis.', 'The Apollo is a superior 3 star first class central hotel which displays the true values of Greek Hospitality.\nWith 51 quality rooms we are always able to provide accommodation to your satisfaction and comfort, with room ranging from singles to suites.\nAll rooms are graciously appointed with all the amenities a customer requires of the even demanding hotel market. With luxury fittings providing maximum comfort and convenience for all our guests, we are certain that your room will be to your satisfaction, and ensure that our high standards equate to excellent value for money.\nCombined with comfortably sized public areas, HR Bar & Restaurant and the Roof Garden with the breathtaking view of Acropolis.\nHotel Apollo is located in Karaiskaki sq. 10, Ahilleos str,\n2 min. walk from Meraxourgio Metro Station allowing for easy Rail ( Larissa International Train Station - 500 m. ) and Bus access, with convenient reach to Plaka (Old Town of Athens) and Acropolis.\nBeing so centrally located will enable you to move easily around the city, enjoying the sites that Athens has to offer.\nThe Apollo provides one of the warmest welcomes as well as being one of the best value for money hotels in Athens.', 1, 'Yes', 'Yes', '3.3333000', 3, '2020-05-28 20:15:36', '2023-03-05 15:01:02'),
(4, 2, 'Oscar Hotel', 'Athens', 'City Center', 'room-4.jpg', 'https://maps.google.com/maps?q=Oscar%20Hotel%20Filadelfias%2025&t=&z=13&ie=UTF8&iwloc=&output=embed', 2, 250, 'Filadelfias 25', '37.9973410', '23.7219820', 'Located in the Center of Athens district, 2 km from Acropolis of Athens, Oscar Hotel Athens Athens features views of the terrace. Located near a train station, the hotel has modern rooms and a gourmet restaurant on site.', 'Located in the Center of Athens district, 2 km from Acropolis of Athens, Oscar Hotel Athens Athens features views of the terrace. Located near a train station, the hotel has modern rooms and a gourmet restaurant on site.\nNational Garden is less than 2.8 km away. The accommodation is 2 km from the city center. Located in Athens, the property is close to Graffiti: Knowledge speaks. The hotel is located a 34-minute walk from Athens International Airport \"Eleftherios Venizelos\".\nEach of the rooms at Oscar Hotel Athens has air conditioning, multi-channel TV and electronic key card. In the rooms you will enjoy private bathrooms with a shower, a hairdryer and towels.\nA continental breakfast is served every morning to Oscar Hotel Athens guests. The restaurant serves meals of international cuisine. It has a lounge bar inside the hotel. Serving a wide range of dishes, O Stathmos Psitopoleio and BeeRaki can be reached within 175 meters.', 0, 'Yes', 'No', '2.0000000', 2, '2020-05-28 20:15:36', '2023-03-05 15:05:34'),
(5, 2, 'Anatolia Hotel', 'Thessaloniki', 'City Center', 'room-5.jpg', 'https://maps.google.com/maps?q=ANATOLIA%20HOTEL%20THESSALONIKI,KENTRO&t=&z=13&ie=UTF8&iwloc=&output=embed', 2, 400, 'Lagkada 13', '40.6477560', '22.9342730', 'The Anatolia Hotel Thessaloniki is a convenient, elegant and stylish establishment right in the heart of the financial, commercial and nightlife district.', 'The Anatolia Hotel Thessaloniki is a convenient, elegant and stylish establishment right in the heart of the financial, commercial and nightlife district.\nIt uniquely combines, the dynamic of a modern spa, conference and business hotel with the luxury of a relaxing vacation hotel. Make your way through elegantly decorated interiors, enjoy gourmet cuisine and cocktails at the Aqua Lounge Bar Restaurant or give in to the rejuvenating experience of All Senses Fitness and Health Club.Services include:Free Wi-Fi internet, Dry cleaning, Room Service, Parking, Secretarial Service, Bussiness Center, Car Rental.', 1, 'Yes', 'Yes', NULL, 0, '2020-05-28 20:15:36', '2023-03-05 15:15:19'),
(6, 3, 'Nea Metropolis Hotel', 'Thessaloniki', 'City Center', 'room-6.jpg', 'https://maps.google.com/maps?q=Nea%20Metropolis%20Hotel%20Thessaloniki&t=&z=13&ie=UTF8&iwloc=&output=embed', 3, 320, 'Siggrou 22', '40.6446290', '22.9409210', 'Housed in a traditional architectural building at Thessaloniki city center, Nea Metropolis Hotel is a family run hotel offering affordable hospitality services for several decades.', 'Housed in a traditional architectural building at Thessaloniki city center, Nea Metropolis Hotel is a family run hotel offering affordable hospitality services for several decades.\nAll rooms at Nea Metropolis Hotel are ensuite, equipped with bathroom amenities, , central heating, hairdryer, Air Condition, safe, 32inch T.V, telephone, fridge and free Wi Fi connection.\nDue to his unique location at Thessaloniki city center, Nea Metropolis Hotel is a step away from shopping and business center, nightlife and all major monuments and sightseeing attractions of Thessaloniki. Aristotelous Square, International Trade Fair center, White Tower, Thessaloniki Port, Ladadika, Thessaloniki bus and train station, a breath away from Nea Metropolis Hotel.', 0, 'Yes', 'No', NULL, 0, '2020-05-28 20:15:36', '2023-03-05 15:18:00'),
(7, 2, 'Airotel Galaxy Hotel', 'Kavala', 'City Center', 'room-7.jpg', 'https://maps.google.com/maps?q=Airotel%20Galaxy%20Hotel%20Kavala&t=&z=13&ie=UTF8&iwloc=&output=embed', 2, 170, 'El. Venizelou 27', '40.9431210', '24.4100360', 'The Airotel Group offers to the city of Kavala the “Galaxy” hotel it deserves! The fully reconstructed and renovated building, in space and service, combines the modern aesthetic and technology with its long lasting fame, respectul of the areas’ traditions', 'The Airotel Group offers to the city of Kavala the “Galaxy” hotel it deserves! The fully reconstructed and renovated building, in space and service, combines the modern aesthetic and technology with its long lasting fame, respectul of the areas’ traditions. Galaxy hotel is ready to satisfy its guests needs via their high quality services. Our guests can use our fully equipped fitness center and for business needs a business corner is available.', 1, 'Yes', 'Yes', '4.0000000', 2, '2020-05-28 20:15:36', '2023-03-05 15:22:14'),
(8, 4, 'Egnatia City Hotel', 'Kavala', 'City Center', 'room-8.jpg', 'https://maps.google.com/maps?q=Egnatia%20City%20Hotel%20Kavala&t=&z=13&ie=UTF8&iwloc=&output=embed', 4, 280, '7is Merarchias 139', '40.9479970', '24.3874950', 'Recently renovated, our rooms combine elegance with modern comfort that you would expect to be offered in a luxury hotel.\n\nSoft colors and the warmth of the wood create a calm environment. Ample space facilitates all your activities.', 'Recently renovated, our rooms combine elegance with modern comfort that you would expect to be offered in a luxury hotel.\nSoft colors and the warmth of the wood create a calm environment. Ample space facilitates all your activities.\nThe bathroom offer bathtubs or showers, communication system, cotton slippers, professional hair dryer, scale and personal care products.', 1, 'Yes', 'No', NULL, 0, '2020-05-28 20:15:36', '2023-03-05 15:26:50'),
(9, 2, 'Villa Manos Hotel Santorini', 'Santorini', 'Chora', 'room-9.jpg', 'https://maps.google.com/maps?q=Villa%20Manos%20Hotel%20Santorini%20Santorini&t=&z=13&ie=UTF8&iwloc=&output=embed', 2, 300, 'Karterados', '36.4131770', '25.4478070', 'The traditionally built Villa Manos is located in Karterados, at a distance of 1.5 km. from Fira. It offers an outdoor swimming pool and a paved sun terrace with sea views. This family-run complex also includes a bar-restaurant and elegantly decorated units with free Wi-Fi.', 'The traditionally built Villa Manos is located in Karterados, at a distance of 1.5 km. from Fira. It offers an outdoor swimming pool and a paved sun terrace with sea views. This family-run complex also includes a bar-restaurant and elegantly decorated units with free Wi-Fi.\nRooms at Villa Manos feature soft colors, white iron beds, air conditioning, TV and private bathroom with shower. Some units have a balcony.\nSantorini Airport is 4 km away. from the accommodation, while the port of Ormos Athiniou is located 8 km. away. A shuttle service is available upon request and at an additional cost.', 0, 'Yes', 'No', NULL, 0, '2020-05-28 20:15:36', '2023-03-05 15:29:06'),
(10, 3, 'Volcano View Hotel Santorini', 'Santorini', 'Chora', 'room-10.jpg', 'https://maps.google.com/maps?q=Volcano%20View%20Hotel%20Santorini%20Santorini&t=&z=13&ie=UTF8&iwloc=&output=embed', 3, 410, 'Fira', '36.4006410', '25.4377640', 'A timeless panorama of natural beauty, perched wonderfully on the outstanding Santorini caldera cliffs.', 'A timeless panorama of natural beauty, perched wonderfully on the outstanding Santorini caldera cliffs. Volcano View is a luxury hotel that offers supreme accommodation in the most privileged spot of Santorini. High quality services and pure comfort are blended in an inspiring atmosphere of relaxation and rejuvenation, with the energy of the volcano overwhelming you.', 1, 'Yes', 'No', NULL, 0, '2020-05-28 20:15:36', '2023-03-05 15:31:41');

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`type_id`, `title`) VALUES
(1, 'Single Room'),
(2, 'Double Room'),
(3, 'Triple Room'),
(4, 'Fourfold Room');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `created_time`, `updated_time`) VALUES
(141, 'DimitrisKarapialis', 'jim@yahoo.gr', '$2y$10$tcu0AIKgosbpBeitgI384OqJhH.mj1Kl2VN/EWKxQ.UYhrH5UdVui', '2022-09-07 14:53:56', '2022-09-07 14:53:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking__room_idx` (`room_id`),
  ADD KEY `fk_booking__user_idx` (`user_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`user_id`,`room_id`),
  ADD KEY `fk_favorite__room_idx` (`room_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review__room_idx` (`room_id`),
  ADD KEY `fk_review__user_idx` (`user_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `idx_name` (`name`) USING BTREE,
  ADD UNIQUE KEY `idx_price` (`room_id`),
  ADD KEY `fk_room__room_type_idx` (`type_id`),
  ADD KEY `idx_city__price` (`city`,`price`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favorite__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room__room_type` FOREIGN KEY (`type_id`) REFERENCES `room_type` (`type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
