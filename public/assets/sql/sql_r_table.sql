/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_zero_research

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 14/04/2024 05:32:52
*/
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for r_values
-- ----------------------------
DROP TABLE IF EXISTS `r_values`;
CREATE TABLE `r_values`  (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `item` bigint NULL DEFAULT NULL,
  `r_01` varchar(255) NULL DEFAULT NULL,
  `r_005` varchar(255) NULL DEFAULT NULL,
  `r_002` varchar(255) NULL DEFAULT NULL,
  `r_001` varchar(255) NULL DEFAULT NULL,
  `r_0001` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 310 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of r_values
-- ----------------------------

INSERT INTO `r_values` VALUES (null, 1, '0.9877', '0.9969', '0.9995', '0.9999', '1.0000');
INSERT INTO `r_values` VALUES (null, 2, '0.9000', '0.9500', '0.9800', '0.9900', '0.9990');
INSERT INTO `r_values` VALUES (null, 3, '0.8054', '0.8783', '0.9343', '0.9587', '0.9911');
INSERT INTO `r_values` VALUES (null, 4, '0.7293', '0.8114', '0.8822', '0.9172', '0.9741');
INSERT INTO `r_values` VALUES (null, 5, '0.6694', '0.7545', '0.8329', '0.8745', '0.9509');
INSERT INTO `r_values` VALUES (null, 6, '0.6215', '0.7067', '0.7887', '0.8343', '0.9249');
INSERT INTO `r_values` VALUES (null, 7, '0.5822', '0.6664', '0.7498', '0.7977', '0.8983');
INSERT INTO `r_values` VALUES (null, 8, '0.5494', '0.6319', '0.7155', '0.7646', '0.8721');
INSERT INTO `r_values` VALUES (null, 9, '0.5214', '0.6021', '0.6851', '0.7348', '0.8470');
INSERT INTO `r_values` VALUES (null, 10, '0.4973', '0.5760', '0.6581', '0.7079', '0.8233');
INSERT INTO `r_values` VALUES (null, 11, '0.4762', '0.5529', '0.6339', '0.6835', '0.8010');
INSERT INTO `r_values` VALUES (null, 12, '0.4575', '0.5324', '0.6120', '0.6614', '0.7800');
INSERT INTO `r_values` VALUES (null, 13, '0.4409', '0.5140', '0.5923', '0.6411', '0.7604');
INSERT INTO `r_values` VALUES (null, 14, '0.4259', '0.4973', '0.5742', '0.6226', '0.7419');
INSERT INTO `r_values` VALUES (null, 15, '0.4124', '0.4821', '0.5577', '0.6055', '0.7247');
INSERT INTO `r_values` VALUES (null, 16, '0.4000', '0.4683', '0.5425', '0.5897', '0.7084');
INSERT INTO `r_values` VALUES (null, 17, '0.3887', '0.4555', '0.5285', '0.5751', '0.6932');
INSERT INTO `r_values` VALUES (null, 18, '0.3783', '0.4438', '0.5155', '0.5614', '0.6788');
INSERT INTO `r_values` VALUES (null, 19, '0.3687', '0.4329', '0.5034', '0.5487', '0.6652');
INSERT INTO `r_values` VALUES (null, 20, '0.3598', '0.4227', '0.4921', '0.5368', '0.6524');
INSERT INTO `r_values` VALUES (null, 21, '0.3515', '0.4132', '0.4815', '0.5256', '0.6402');
INSERT INTO `r_values` VALUES (null, 22, '0.3438', '0.4044', '0.4716', '0.5151', '0.6287');
INSERT INTO `r_values` VALUES (null, 23, '0.3365', '0.3961', '0.4622', '0.5052', '0.6178');
INSERT INTO `r_values` VALUES (null, 24, '0.3297', '0.3882', '0.4534', '0.4958', '0.6074');
INSERT INTO `r_values` VALUES (null, 25, '0.3233', '0.3809', '0.4451', '0.4869', '0.5974');
INSERT INTO `r_values` VALUES (null, 26, '0.3172', '0.3739', '0.4372', '0.4785', '0.5880');
INSERT INTO `r_values` VALUES (null, 27, '0.3115', '0.3673', '0.4297', '0.4705', '0.5790');
INSERT INTO `r_values` VALUES (null, 28, '0.3061', '0.3610', '0.4226', '0.4629', '0.5703');
INSERT INTO `r_values` VALUES (null, 29, '0.3009', '0.3550', '0.4158', '0.4556', '0.5620');
INSERT INTO `r_values` VALUES (null, 30, '0.2960', '0.3494', '0.4093', '0.4487', '0.5541');
INSERT INTO `r_values` VALUES (null, 31, '0.2913', '0.3440', '0.4032', '0.4421', '0.5465');
INSERT INTO `r_values` VALUES (null, 32, '0.2869', '0.3388', '0.3972', '0.4357', '0.5392');
INSERT INTO `r_values` VALUES (null, 33, '0.2826', '0.3338', '0.3916', '0.4296', '0.5322');
INSERT INTO `r_values` VALUES (null, 34, '0.2785', '0.3291', '0.3862', '0.4238', '0.5254');
INSERT INTO `r_values` VALUES (null, 35, '0.2746', '0.3246', '0.3810', '0.4182', '0.5189');
INSERT INTO `r_values` VALUES (null, 36, '0.2709', '0.3202', '0.3760', '0.4128', '0.5126');
INSERT INTO `r_values` VALUES (null, 37, '0.2673', '0.3160', '0.3712', '0.4076', '0.5066');
INSERT INTO `r_values` VALUES (null, 38, '0.2638', '0.3120', '0.3665', '0.4026', '0.5007');
INSERT INTO `r_values` VALUES (null, 39, '0.2605', '0.3081', '0.3621', '0.3978', '0.4950');
INSERT INTO `r_values` VALUES (null, 40, '0.2573', '0.3044', '0.3578', '0.3932', '0.4896');
INSERT INTO `r_values` VALUES (null, 41, '0.2542', '0.3008', '0.3536', '0.3887', '0.4843');
INSERT INTO `r_values` VALUES (null, 42, '0.2512', '0.2973', '0.3496', '0.3843', '0.4791');
INSERT INTO `r_values` VALUES (null, 43, '0.2483', '0.2940', '0.3457', '0.3801', '0.4742');
INSERT INTO `r_values` VALUES (null, 44, '0.2455', '0.2907', '0.3420', '0.3761', '0.4694');
INSERT INTO `r_values` VALUES (null, 45, '0.2429', '0.2876', '0.3384', '0.3721', '0.4647');
INSERT INTO `r_values` VALUES (null, 46, '0.2403', '0.2845', '0.3348', '0.3683', '0.4601');
INSERT INTO `r_values` VALUES (null, 47, '0.2377', '0.2816', '0.3314', '0.3646', '0.4557');
INSERT INTO `r_values` VALUES (null, 48, '0.2353', '0.2787', '0.3281', '0.3610', '0.4514');
INSERT INTO `r_values` VALUES (null, 49, '0.2329', '0.2759', '0.3249', '0.3575', '0.4473');
INSERT INTO `r_values` VALUES (null, 50, '0.2306', '0.2732', '0.3218', '0.3542', '0.4432');
INSERT INTO `r_values` VALUES (null, 51, '0.2284', '0.2706', '0.3188', '0.3509', '0.4393');
INSERT INTO `r_values` VALUES (null, 52, '0.2262', '0.2681', '0.3158', '0.3477', '0.4354');
INSERT INTO `r_values` VALUES (null, 53, '0.2241', '0.2656', '0.3129', '0.3445', '0.4317');
INSERT INTO `r_values` VALUES (null, 54, '0.2221', '0.2632', '0.3102', '0.3415', '0.4280');
INSERT INTO `r_values` VALUES (null, 55, '0.2201', '0.2609', '0.3074', '0.3385', '0.4244');
INSERT INTO `r_values` VALUES (null, 56, '0.2181', '0.2586', '0.3048', '0.3357', '0.4210');
INSERT INTO `r_values` VALUES (null, 57, '0.2162', '0.2564', '0.3022', '0.3328', '0.4176');
INSERT INTO `r_values` VALUES (null, 58, '0.2144', '0.2542', '0.2997', '0.3301', '0.4143');
INSERT INTO `r_values` VALUES (null, 59, '0.2126', '0.2521', '0.2972', '0.3274', '0.4110');
INSERT INTO `r_values` VALUES (null, 60, '0.2108', '0.2500', '0.2948', '0.3248', '0.4079');
INSERT INTO `r_values` VALUES (null, 61, '0.2091', '0.2480', '0.2925', '0.3223', '0.4048');
INSERT INTO `r_values` VALUES (null, 62, '0.2075', '0.2461', '0.2902', '0.3198', '0.4018');
INSERT INTO `r_values` VALUES (null, 63, '0.2058', '0.2441', '0.2880', '0.3173', '0.3988');
INSERT INTO `r_values` VALUES (null, 64, '0.2042', '0.2423', '0.2858', '0.3150', '0.3959');
INSERT INTO `r_values` VALUES (null, 65, '0.2027', '0.2404', '0.2837', '0.3126', '0.3931');
INSERT INTO `r_values` VALUES (null, 66, '0.2012', '0.2387', '0.2816', '0.3104', '0.3903');
INSERT INTO `r_values` VALUES (null, 67, '0.1997', '0.2369', '0.2796', '0.3081', '0.3876');
INSERT INTO `r_values` VALUES (null, 68, '0.1982', '0.2352', '0.2776', '0.3060', '0.3850');
INSERT INTO `r_values` VALUES (null, 69, '0.1968', '0.2335', '0.2756', '0.3038', '0.3823');
INSERT INTO `r_values` VALUES (null, 70, '0.1954', '0.2319', '0.2737', '0.3017', '0.3798');
INSERT INTO `r_values` VALUES (null, 71, '0.1940', '0.2303', '0.2718', '0.2997', '0.3773');
INSERT INTO `r_values` VALUES (null, 72, '0.1927', '0.2287', '0.2700', '0.2977', '0.3748');
INSERT INTO `r_values` VALUES (null, 73, '0.1914', '0.2272', '0.2682', '0.2957', '0.3724');
INSERT INTO `r_values` VALUES (null, 74, '0.1901', '0.2257', '0.2664', '0.2938', '0.3701');
INSERT INTO `r_values` VALUES (null, 75, '0.1888', '0.2242', '0.2647', '0.2919', '0.3678');
INSERT INTO `r_values` VALUES (null, 76, '0.1876', '0.2227', '0.2630', '0.2900', '0.3655');
INSERT INTO `r_values` VALUES (null, 77, '0.1864', '0.2213', '0.2613', '0.2882', '0.3633');
INSERT INTO `r_values` VALUES (null, 78, '0.1852', '0.2199', '0.2597', '0.2864', '0.3611');
INSERT INTO `r_values` VALUES (null, 79, '0.1841', '0.2185', '0.2581', '0.2847', '0.3589');
INSERT INTO `r_values` VALUES (null, 80, '0.1829', '0.2172', '0.2565', '0.2830', '0.3568');
INSERT INTO `r_values` VALUES (null, 81, '0.1818', '0.2159', '0.2550', '0.2813', '0.3547');
INSERT INTO `r_values` VALUES (null, 82, '0.1807', '0.2146', '0.2535', '0.2796', '0.3527');
INSERT INTO `r_values` VALUES (null, 83, '0.1796', '0.2133', '0.2520', '0.2780', '0.3507');
INSERT INTO `r_values` VALUES (null, 84, '0.1786', '0.2120', '0.2505', '0.2764', '0.3487');
INSERT INTO `r_values` VALUES (null, 85, '0.1775', '0.2108', '0.2491', '0.2748', '0.3468');
INSERT INTO `r_values` VALUES (null, 86, '0.1765', '0.2096', '0.2477', '0.2732', '0.3449');
INSERT INTO `r_values` VALUES (null, 87, '0.1755', '0.2084', '0.2463', '0.2717', '0.3430');
INSERT INTO `r_values` VALUES (null, 88, '0.1745', '0.2072', '0.2449', '0.2702', '0.3412');
INSERT INTO `r_values` VALUES (null, 89, '0.1735', '0.2061', '0.2435', '0.2687', '0.3393');
INSERT INTO `r_values` VALUES (null, 90, '0.1726', '0.2050', '0.2422', '0.2673', '0.3375');
INSERT INTO `r_values` VALUES (null, 91, '0.1716', '0.2039', '0.2409', '0.2659', '0.3358');
INSERT INTO `r_values` VALUES (null, 92, '0.1707', '0.2028', '0.2396', '0.2645', '0.3341');
INSERT INTO `r_values` VALUES (null, 93, '0.1698', '0.2017', '0.2384', '0.2631', '0.3323');
INSERT INTO `r_values` VALUES (null, 94, '0.1689', '0.2006', '0.2371', '0.2617', '0.3307');
INSERT INTO `r_values` VALUES (null, 95, '0.1680', '0.1996', '0.2359', '0.2604', '0.3290');
INSERT INTO `r_values` VALUES (null, 96, '0.1671', '0.1986', '0.2347', '0.2591', '0.3274');
INSERT INTO `r_values` VALUES (null, 97, '0.1663', '0.1975', '0.2335', '0.2578', '0.3258');
INSERT INTO `r_values` VALUES (null, 98, '0.1654', '0.1966', '0.2324', '0.2565', '0.3242');
INSERT INTO `r_values` VALUES (null, 99, '0.1646', '0.1956', '0.2312', '0.2552', '0.3226');
INSERT INTO `r_values` VALUES (null, 100, '0.1638', '0.1946', '0.2301', '0.2540', '0.3211');
INSERT INTO `r_values` VALUES (null, 101, '0.1630', '0.1937', '0.2290', '0.2528', '0.3196');
INSERT INTO `r_values` VALUES (null, 102, '0.1622', '0.1927', '0.2279', '0.2515', '0.3181');
INSERT INTO `r_values` VALUES (null, 103, '0.1614', '0.1918', '0.2268', '0.2504', '0.3166');
INSERT INTO `r_values` VALUES (null, 104, '0.1606', '0.1909', '0.2257', '0.2492', '0.3152');
INSERT INTO `r_values` VALUES (null, 105, '0.1599', '0.1900', '0.2247', '0.2480', '0.3137');
INSERT INTO `r_values` VALUES (null, 106, '0.1591', '0.1891', '0.2236', '0.2469', '0.3123');
INSERT INTO `r_values` VALUES (null, 107, '0.1584', '0.1882', '0.2226', '0.2458', '0.3109');
INSERT INTO `r_values` VALUES (null, 108, '0.1576', '0.1874', '0.2216', '0.2446', '0.3095');
INSERT INTO `r_values` VALUES (null, 109, '0.1569', '0.1865', '0.2206', '0.2436', '0.3082');
INSERT INTO `r_values` VALUES (null, 110, '0.1562', '0.1857', '0.2196', '0.2425', '0.3068');
INSERT INTO `r_values` VALUES (null, 111, '0.1555', '0.1848', '0.2186', '0.2414', '0.3055');
INSERT INTO `r_values` VALUES (null, 112, '0.1548', '0.1840', '0.2177', '0.2403', '0.3042');
INSERT INTO `r_values` VALUES (null, 113, '0.1541', '0.1832', '0.2167', '0.2393', '0.3029');
INSERT INTO `r_values` VALUES (null, 114, '0.1535', '0.1824', '0.2158', '0.2383', '0.3016');
INSERT INTO `r_values` VALUES (null, 115, '0.1528', '0.1816', '0.2149', '0.2373', '0.3004');
INSERT INTO `r_values` VALUES (null, 116, '0.1522', '0.1809', '0.2139', '0.2363', '0.2991');
INSERT INTO `r_values` VALUES (null, 117, '0.1515', '0.1801', '0.2131', '0.2353', '0.2979');
INSERT INTO `r_values` VALUES (null, 118, '0.1509', '0.1793', '0.2122', '0.2343', '0.2967');
INSERT INTO `r_values` VALUES (null, 119, '0.1502', '0.1786', '0.2113', '0.2333', '0.2955');
INSERT INTO `r_values` VALUES (null, 120, '0.1496', '0.1779', '0.2104', '0.2324', '0.2943');
INSERT INTO `r_values` VALUES (null, 121, '0.1490', '0.1771', '0.2096', '0.2315', '0.2931');
INSERT INTO `r_values` VALUES (null, 122, '0.1484', '0.1764', '0.2087', '0.2305', '0.2920');
INSERT INTO `r_values` VALUES (null, 123, '0.1478', '0.1757', '0.2079', '0.2296', '0.2908');
INSERT INTO `r_values` VALUES (null, 124, '0.1472', '0.1750', '0.2071', '0.2287', '0.2897');
INSERT INTO `r_values` VALUES (null, 125, '0.1466', '0.1743', '0.2062', '0.2278', '0.2886');
INSERT INTO `r_values` VALUES (null, 126, '0.1460', '0.1736', '0.2054', '0.2269', '0.2875');
INSERT INTO `r_values` VALUES (null, 127, '0.1455', '0.1729', '0.2046', '0.2260', '0.2864');
INSERT INTO `r_values` VALUES (null, 128, '0.1449', '0.1723', '0.2039', '0.2252', '0.2853');
INSERT INTO `r_values` VALUES (null, 129, '0.1443', '0.1716', '0.2031', '0.2243', '0.2843');
INSERT INTO `r_values` VALUES (null, 130, '0.1438', '0.1710', '0.2023', '0.2235', '0.2832');
INSERT INTO `r_values` VALUES (null, 131, '0.1432', '0.1703', '0.2015', '0.2226', '0.2822');
INSERT INTO `r_values` VALUES (null, 132, '0.1427', '0.1697', '0.2008', '0.2218', '0.2811');
INSERT INTO `r_values` VALUES (null, 133, '0.1422', '0.1690', '0.2001', '0.2210', '0.2801');
INSERT INTO `r_values` VALUES (null, 134, '0.1416', '0.1684', '0.1993', '0.2202', '0.2791');
INSERT INTO `r_values` VALUES (null, 135, '0.1411', '0.1678', '0.1986', '0.2194', '0.2781');
INSERT INTO `r_values` VALUES (null, 136, '0.1406', '0.1672', '0.1979', '0.2186', '0.2771');
INSERT INTO `r_values` VALUES (null, 137, '0.1401', '0.1666', '0.1972', '0.2178', '0.2761');
INSERT INTO `r_values` VALUES (null, 138, '0.1396', '0.1660', '0.1965', '0.2170', '0.2752');
INSERT INTO `r_values` VALUES (null, 139, '0.1391', '0.1654', '0.1958', '0.2163', '0.2742');
INSERT INTO `r_values` VALUES (null, 140, '0.1386', '0.1648', '0.1951', '0.2155', '0.2733');
INSERT INTO `r_values` VALUES (null, 141, '0.1381', '0.1642', '0.1944', '0.2148', '0.2723');
INSERT INTO `r_values` VALUES (null, 142, '0.1376', '0.1637', '0.1937', '0.2140', '0.2714');
INSERT INTO `r_values` VALUES (null, 143, '0.1371', '0.1631', '0.1930', '0.2133', '0.2705');
INSERT INTO `r_values` VALUES (null, 144, '0.1367', '0.1625', '0.1924', '0.2126', '0.2696');
INSERT INTO `r_values` VALUES (null, 145, '0.1362', '0.1620', '0.1917', '0.2118', '0.2687');
INSERT INTO `r_values` VALUES (null, 146, '0.1357', '0.1614', '0.1911', '0.2111', '0.2678');
INSERT INTO `r_values` VALUES (null, 147, '0.1353', '0.1609', '0.1904', '0.2104', '0.2669');
INSERT INTO `r_values` VALUES (null, 148, '0.1348', '0.1603', '0.1898', '0.2097', '0.2660');
INSERT INTO `r_values` VALUES (null, 149, '0.1344', '0.1598', '0.1892', '0.2090', '0.2652');
INSERT INTO `r_values` VALUES (null, 150, '0.1339', '0.1593', '0.1886', '0.2083', '0.2643');
INSERT INTO `r_values` VALUES (null, 151, '0.1335', '0.1587', '0.1879', '0.2077', '0.2635');
INSERT INTO `r_values` VALUES (null, 152, '0.1330', '0.1582', '0.1873', '0.2070', '0.2626');
INSERT INTO `r_values` VALUES (null, 153, '0.1326', '0.1577', '0.1867', '0.2063', '0.2618');
INSERT INTO `r_values` VALUES (null, 154, '0.1322', '0.1572', '0.1861', '0.2057', '0.2610');
INSERT INTO `r_values` VALUES (null, 155, '0.1318', '0.1567', '0.1855', '0.2050', '0.2602');
INSERT INTO `r_values` VALUES (null, 156, '0.1313', '0.1562', '0.1849', '0.2044', '0.2593');
INSERT INTO `r_values` VALUES (null, 157, '0.1309', '0.1557', '0.1844', '0.2037', '0.2585');
INSERT INTO `r_values` VALUES (null, 158, '0.1305', '0.1552', '0.1838', '0.2031', '0.2578');
INSERT INTO `r_values` VALUES (null, 159, '0.1301', '0.1547', '0.1832', '0.2025', '0.2570');
INSERT INTO `r_values` VALUES (null, 160, '0.1297', '0.1543', '0.1826', '0.2019', '0.2562');
INSERT INTO `r_values` VALUES (null, 161, '0.1293', '0.1538', '0.1821', '0.2012', '0.2554');
INSERT INTO `r_values` VALUES (null, 162, '0.1289', '0.1533', '0.1815', '0.2006', '0.2546');
INSERT INTO `r_values` VALUES (null, 163, '0.1285', '0.1528', '0.1810', '0.2000', '0.2539');
INSERT INTO `r_values` VALUES (null, 164, '0.1281', '0.1524', '0.1804', '0.1994', '0.2531');
INSERT INTO `r_values` VALUES (null, 165, '0.1277', '0.1519', '0.1799', '0.1988', '0.2524');
INSERT INTO `r_values` VALUES (null, 166, '0.1273', '0.1515', '0.1794', '0.1982', '0.2517');
INSERT INTO `r_values` VALUES (null, 167, '0.1270', '0.1510', '0.1788', '0.1976', '0.2509');
INSERT INTO `r_values` VALUES (null, 168, '0.1266', '0.1506', '0.1783', '0.1971', '0.2502');
INSERT INTO `r_values` VALUES (null, 169, '0.1262', '0.1501', '0.1778', '0.1965', '0.2495');
INSERT INTO `r_values` VALUES (null, 170, '0.1258', '0.1497', '0.1773', '0.1959', '0.2488');
INSERT INTO `r_values` VALUES (null, 171, '0.1255', '0.1493', '0.1768', '0.1954', '0.2481');
INSERT INTO `r_values` VALUES (null, 172, '0.1251', '0.1488', '0.1762', '0.1948', '0.2473');
INSERT INTO `r_values` VALUES (null, 173, '0.1247', '0.1484', '0.1757', '0.1942', '0.2467');
INSERT INTO `r_values` VALUES (null, 174, '0.1244', '0.1480', '0.1752', '0.1937', '0.2460');
INSERT INTO `r_values` VALUES (null, 175, '0.1240', '0.1476', '0.1747', '0.1932', '0.2453');
INSERT INTO `r_values` VALUES (null, 176, '0.1237', '0.1471', '0.1743', '0.1926', '0.2446');
INSERT INTO `r_values` VALUES (null, 177, '0.1233', '0.1467', '0.1738', '0.1921', '0.2439');
INSERT INTO `r_values` VALUES (null, 178, '0.1230', '0.1463', '0.1733', '0.1915', '0.2433');
INSERT INTO `r_values` VALUES (null, 179, '0.1226', '0.1459', '0.1728', '0.1910', '0.2426');
INSERT INTO `r_values` VALUES (null, 180, '0.1223', '0.1455', '0.1723', '0.1905', '0.2419');
INSERT INTO `r_values` VALUES (null, 181, '0.1220', '0.1451', '0.1719', '0.1900', '0.2413');
INSERT INTO `r_values` VALUES (null, 182, '0.1216', '0.1447', '0.1714', '0.1895', '0.2406');
INSERT INTO `r_values` VALUES (null, 183, '0.1213', '0.1443', '0.1709', '0.1890', '0.2400');
INSERT INTO `r_values` VALUES (null, 184, '0.1210', '0.1439', '0.1705', '0.1884', '0.2394');
INSERT INTO `r_values` VALUES (null, 185, '0.1207', '0.1435', '0.1700', '0.1879', '0.2387');
INSERT INTO `r_values` VALUES (null, 186, '0.1203', '0.1432', '0.1696', '0.1874', '0.2381');
INSERT INTO `r_values` VALUES (null, 187, '0.1200', '0.1428', '0.1691', '0.1869', '0.2375');
INSERT INTO `r_values` VALUES (null, 188, '0.1197', '0.1424', '0.1687', '0.1865', '0.2369');
INSERT INTO `r_values` VALUES (null, 189, '0.1194', '0.1420', '0.1682', '0.1860', '0.2363');
INSERT INTO `r_values` VALUES (null, 190, '0.1191', '0.1417', '0.1678', '0.1855', '0.2357');
INSERT INTO `r_values` VALUES (null, 191, '0.1188', '0.1413', '0.1674', '0.1850', '0.2351');
INSERT INTO `r_values` VALUES (null, 192, '0.1184', '0.1409', '0.1669', '0.1845', '0.2345');
INSERT INTO `r_values` VALUES (null, 193, '0.1181', '0.1406', '0.1665', '0.1841', '0.2339');
INSERT INTO `r_values` VALUES (null, 194, '0.1178', '0.1402', '0.1661', '0.1836', '0.2333');
INSERT INTO `r_values` VALUES (null, 195, '0.1175', '0.1398', '0.1657', '0.1831', '0.2327');
INSERT INTO `r_values` VALUES (null, 196, '0.1172', '0.1395', '0.1652', '0.1827', '0.2321');
INSERT INTO `r_values` VALUES (null, 197, '0.1169', '0.1391', '0.1648', '0.1822', '0.2315');
INSERT INTO `r_values` VALUES (null, 198, '0.1166', '0.1388', '0.1644', '0.1818', '0.2310');
INSERT INTO `r_values` VALUES (null, 199, '0.1164', '0.1384', '0.1640', '0.1813', '0.2304');
INSERT INTO `r_values` VALUES (null, 200, '0.1161', '0.1381', '0.1636', '0.1809', '0.2298');

SET FOREIGN_KEY_CHECKS = 1;
