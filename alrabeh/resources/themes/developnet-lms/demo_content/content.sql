-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table alrabeh.lms_answers: ~12 rows (approximately)
/*!40000 ALTER TABLE `lms_answers` DISABLE KEYS */;
INSERT INTO `lms_answers` (`id`, `title`, `hint`, `status`, `order`, `is_correct`, `options`, `question_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'اجابه صحيحة', NULL, 0, 0, 1, NULL, 1, 1, 1, NULL, '2018-09-04 14:07:05', '2018-09-04 14:07:05'),
	(2, 'اجابه خاطئة', NULL, 0, 0, 0, NULL, 1, 1, 1, NULL, '2018-09-04 14:07:06', '2018-09-04 14:07:06'),
	(3, 'اجابه خاطءهةة', NULL, 0, 0, 0, NULL, 1, 1, 1, NULL, '2018-09-04 14:07:06', '2018-09-04 14:07:06'),
	(4, 'اجابه صحيحة', NULL, 0, 0, 1, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:11', '2018-09-04 14:08:11'),
	(5, 'اجابه خاطئة', NULL, 0, 0, 0, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:12', '2018-09-04 14:08:12'),
	(6, 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة', NULL, 0, 0, 1, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:12', '2018-09-04 14:08:12'),
	(7, 'لقد تم توليد هذا النص من مولد النص العربى', NULL, 0, 0, 0, NULL, 2, 1, 1, NULL, '2018-09-04 14:08:12', '2018-09-04 14:08:12'),
	(8, 'مفهوم', NULL, 0, 0, 1, NULL, 3, 1, 1, NULL, '2018-09-04 14:11:01', '2018-09-04 14:11:01'),
	(9, 'غير منظم', NULL, 0, 0, 0, NULL, 3, 1, 1, NULL, '2018-09-04 14:11:01', '2018-09-04 14:11:01'),
	(10, 'و حتى غير مفهوم.', NULL, 0, 0, 0, NULL, 3, 1, 1, NULL, '2018-09-04 14:11:02', '2018-09-04 14:11:02'),
	(13, 'اجابه صحيحة', NULL, 0, 0, 1, NULL, 4, 1, 1, NULL, '2018-09-04 14:16:11', '2018-09-04 14:16:11'),
	(14, 'اجابه خاطئة', NULL, 0, 0, 0, NULL, 4, 1, 1, NULL, '2018-09-04 14:16:11', '2018-09-04 14:16:11');
/*!40000 ALTER TABLE `lms_answers` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_categoriables: ~17 rows (approximately)
/*!40000 ALTER TABLE `lms_categoriables` DISABLE KEYS */;
INSERT INTO `lms_categoriables` (`lms_categoriable_type`, `lms_categoriable_id`, `category_id`) VALUES
	('quiz', 3, 2),
	('quiz', 3, 4),
	('quiz', 4, 1),
	('quiz', 4, 4),
	('quiz', 4, 3),
	('quiz', 5, 2),
	('quiz', 6, 4),
	('quiz', 7, 2),
	('quiz', 7, 1),
	('quiz', 7, 4),
	('quiz', 7, 3),
	('course', 3, 2),
	('course', 3, 3),
	('course', 2, 2),
	('lesson', 5, 3),
	('lesson', 4, 3),
	('lesson', 3, 1);
/*!40000 ALTER TABLE `lms_categoriables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `lms_categories` DISABLE KEYS */;
INSERT INTO `lms_categories` (`id`, `name`, `slug`, `is_featured`, `in_home`, `status`, `type`, `parent_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'تربيه قوميه', '8652', 0, 0, 'active', 'general', NULL, 1, 1, NULL, '2018-09-04 13:26:41', '2018-09-04 13:26:41'),
	(2, 'تاريخ', '111342', 1, 0, 'active', 'general', 3, 1, 1, NULL, '2018-09-04 13:27:20', '2018-09-05 08:19:04'),
	(3, 'عربية', '1111', 0, 0, 'active', 'general', NULL, 1, 1, NULL, '2018-09-04 13:28:19', '2018-09-04 13:28:19'),
	(4, 'رياضه', '1111km', 1, 0, 'inactive', 'general', NULL, 1, 1, NULL, '2018-09-04 13:30:02', '2018-09-05 08:18:35');
/*!40000 ALTER TABLE `lms_categories` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_certificates: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_certificates` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_certificates` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_certificate_templates: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_certificate_templates` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_certificate_templates` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_couponables: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_couponables` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_couponables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_coupons: ~1 rows (approximately)
/*!40000 ALTER TABLE `lms_coupons` DISABLE KEYS */;
INSERT INTO `lms_coupons` (`id`, `code`, `type`, `uses`, `min_cart_total`, `max_discount_value`, `value`, `start`, `expiry`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, '8Dvc29O7UofWY2', 'fixed', 10, NULL, NULL, '10000', '2018-09-04 06:08:48', '2018-09-07 17:08:51', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lms_coupons` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_coupon_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_coupon_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_coupon_user` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_courseables: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_courseables` DISABLE KEYS */;
INSERT INTO `lms_courseables` (`id`, `order`, `lms_courseable_type`, `lms_courseable_id`, `course_id`, `created_at`, `updated_at`) VALUES
	(1, 0, 'lesson', 1, 2, NULL, NULL),
	(2, 0, 'lesson', 3, 2, NULL, NULL),
	(3, 0, 'lesson', 5, 2, NULL, NULL),
	(4, 0, 'lesson', 2, 2, NULL, NULL),
	(5, 0, 'lesson', 4, 2, NULL, NULL),
	(7, 0, 'quiz', 6, 2, NULL, NULL),
	(8, 0, 'lesson', 6, 3, NULL, NULL);
/*!40000 ALTER TABLE `lms_courseables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_courses: ~4 rows (approximately)
/*!40000 ALTER TABLE `lms_courses` DISABLE KEYS */;
INSERT INTO `lms_courses` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `content`, `summary`, `duration`, `duration_unit`, `max_students`, `enrolled_students`, `retake_count`, `price`, `sale_price`, `featured`, `block_lessons`, `submission_form`, `allow_comments`, `evaluation_type`, `passing_condition`, `passing_grade`, `passing_grade_type`, `featured_image_link`, `preview_video`, `is_featured`, `in_home`, `status`, `published_at`, `published_at_hij`, `started_at`, `started_at_hij`, `options`, `author_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'دوره تاريخ مصري', 'th345k', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى', 7, 'hour', 9, 8, 6, 7.00, 5.00, 0, 0, 0, 0, '', '50', 60, 'percentage', NULL, NULL, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 1, 1, 1, NULL, '2018-09-04 12:53:03', '2018-09-04 12:53:03'),
	(2, 'دوره في اللغه العربية', 'wrwe', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.', 0, 'week', 0, 0, 1, 0.00, 0.00, 1, 1, 0, 1, 'lessons', '50', 60, 'percentage', NULL, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 13:10:30', '2018-09-04 20:29:19'),
	(3, 'دوره تدريبيه عامه', 'sybsyoe', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.&nbsp;ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', 0, 'week', 0, 0, 1, 0.00, 0.00, 1, 0, 0, 1, '', '50', 60, 'percentage', NULL, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:23:34', '2018-09-04 22:37:56'),
	(4, 'دوره تدريبيه جديده', 'shksk', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل ظهر بشكل لا يليق.', 0, 'week', 0, 0, 1, 8.00, 5.00, 0, 0, 0, 0, 'lessons', '50', 60, 'percentage', NULL, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, '2018-09-04 14:25:44', '2018-09-04 14:26:05');
/*!40000 ALTER TABLE `lms_courses` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_invoicables: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_invoicables` DISABLE KEYS */;
INSERT INTO `lms_invoicables` (`id`, `code`, `paid`, `price`, `amount`, `lms_invoicable_type`, `lms_invoicable_id`, `description`, `notes`, `options`, `invoice_id`, `coupon_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(6, 'yEbeu0ez', 14.00, 14.00, 1, 'plan', 1, NULL, NULL, NULL, 6, 1, 1, 1, NULL, NULL, NULL),
	(7, 'aZiFfseM', 0.00, 11.00, 1, 'plan', 2, NULL, NULL, NULL, 7, NULL, 1, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lms_invoicables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_invoices: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_invoices` DISABLE KEYS */;
INSERT INTO `lms_invoices` (`id`, `code`, `currency`, `description`, `notes`, `options`, `status`, `total_price`, `coupon_id`, `user_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(6, 'lmdOYewq9l', 'SR', NULL, NULL, NULL, 'paid', 14.00, 1, 1, 1, 1, NULL, '2018-09-05 23:44:09', '2018-09-05 23:44:09'),
	(7, 'hxjrc0d4t1', 'SR', NULL, NULL, NULL, 'pending', 11.00, NULL, 1, 1, 1, NULL, '2018-09-05 23:55:00', '2018-09-05 23:55:00');
/*!40000 ALTER TABLE `lms_invoices` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_lessons: ~6 rows (approximately)
/*!40000 ALTER TABLE `lms_lessons` DISABLE KEYS */;
INSERT INTO `lms_lessons` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `content`, `duration`, `duration_unit`, `preview_video`, `preview`, `allow_comments`, `status`, `published_at`, `private`, `type`, `options`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'تلخيص لمحتوي الوحدة', 'lesson-11q0412n-cvsfyw4', NULL, NULL, NULL, NULL, 'minute', NULL, 0, 0, 0, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 12:43:40', '2018-09-04 12:43:40'),
	(2, 'نصوص عربيه', 'lesson-1111rxmyyhc1a9mq', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '3', 'minute', NULL, 0, 0, 1, NULL, 0, 'quiz', NULL, 1, 1, NULL, '2018-09-04 12:44:13', '2018-09-04 19:52:29'),
	(3, 'نصوص عربيه هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', 'lesson-1cslef-zh2jjij3x', NULL, NULL, 'https://youtu.be/VdvEdMMtNMY', '3', 'minute', NULL, 0, 1, 1, NULL, 0, 'video', NULL, 1, 1, NULL, '2018-09-04 12:44:27', '2018-09-04 19:50:20'),
	(4, 'مقدمه في الادب المصري', 'lesson-14yi56t1n0asql6e', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>\r\n\r\n<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>\r\n\r\n<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>\r\n\r\n<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '1', 'hour', NULL, 1, 1, 1, NULL, 0, 'docs', NULL, 1, 1, NULL, '2018-09-04 12:44:59', '2018-09-04 19:49:35'),
	(5, 'الادب المصري الحديث', 'lesson-1amjup7cyu-jy5j', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '5', 'minute', NULL, 1, 1, 1, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 12:45:22', '2018-09-04 19:48:18'),
	(6, 'درس جديد', 'lesson-14m9ajnzbo-rhpx3', NULL, NULL, NULL, NULL, 'minute', NULL, 0, 0, 0, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 22:37:37', '2018-09-04 22:37:37');
/*!40000 ALTER TABLE `lms_lessons` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_logs: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_logs` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_media: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_media` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_media` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_plannables: ~25 rows (approximately)
/*!40000 ALTER TABLE `lms_plannables` DISABLE KEYS */;
INSERT INTO `lms_plannables` (`id`, `lms_plannable_id`, `lms_plannable_type`, `order`, `status`, `notes`, `price_options`, `options`, `plan_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 'category', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(2, 3, 'category', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(3, 1, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(4, 2, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(5, 3, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(6, 4, 'quiz', 0, 1, NULL, NULL, NULL, 1, NULL, NULL),
	(7, 2, 'category', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(8, 3, 'category', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(9, 1, 'course', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(10, 2, 'course', 0, 1, NULL, NULL, NULL, 2, NULL, NULL),
	(11, 2, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(12, 1, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(13, 4, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(14, 3, 'category', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(15, 1, 'course', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(16, 2, 'course', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(17, 2, 'quiz', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(18, 4, 'quiz', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(19, 6, 'quiz', 0, 1, NULL, NULL, NULL, 3, NULL, NULL),
	(20, 2, 'category', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(21, 1, 'category', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(22, 1, 'course', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(23, 6, 'quiz', 0, 1, NULL, NULL, NULL, 4, NULL, NULL),
	(24, 1, 'category', 0, 1, NULL, NULL, NULL, 5, NULL, NULL),
	(25, 1, 'course', 0, 1, NULL, NULL, NULL, 5, NULL, NULL);
/*!40000 ALTER TABLE `lms_plannables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_plans: ~5 rows (approximately)
/*!40000 ALTER TABLE `lms_plans` DISABLE KEYS */;
INSERT INTO `lms_plans` (`id`, `title`, `content`, `price`, `sale_price`, `meta_keywords`, `meta_description`, `slug`, `type`, `duration_type`, `duration`, `is_featured`, `is_recommended`, `only_planables`, `status`, `notes`, `price_options`, `options`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'خطة اختبارات فقط', '<p style="text-align: right;">هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', 19.00, 14.00, NULL, NULL, 'home853', 'items', 'months', 1, 1, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 13:46:21', '2018-09-04 13:46:21'),
	(2, 'خطه دورات تدريبيه', '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم&nbsp;<br />\r\n&nbsp;</p>', 18.00, 11.00, NULL, NULL, '1111', 'items', 'months', 1, 0, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 14:34:43', '2018-09-04 14:34:43'),
	(3, 'خطه شاملة', '<p style="text-align: right;">ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 30.00, 30.00, NULL, NULL, 'skths', 'items', 'months', 1, 1, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 14:35:54', '2018-09-04 14:35:54'),
	(4, 'خطه مجانيه', '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 12.00, 0.00, NULL, NULL, '4k4ysyb', 'items', 'months', 1, 1, 0, 0, 1, NULL, NULL, NULL, 1, 1, '2018-09-04 14:37:19', '2018-09-04 14:37:45'),
	(5, 'نص عربي', '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', 8.00, 5.00, NULL, NULL, 'oer', 'items', 'months', 1, 0, 0, 0, 0, NULL, NULL, NULL, 1, 1, '2018-09-04 14:38:58', '2018-09-04 14:38:58');
/*!40000 ALTER TABLE `lms_plans` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_prices: ~0 rows (approximately)
/*!40000 ALTER TABLE `lms_prices` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_prices` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_questions: ~4 rows (approximately)
/*!40000 ALTER TABLE `lms_questions` DISABLE KEYS */;
INSERT INTO `lms_questions` (`id`, `title`, `content`, `duration`, `duration_unit`, `points`, `question_type`, `question_explanation`, `question_hint`, `difficulty`, `show_check_answer`, `skip_question`, `show_hint`, `allow_comments`, `status`, `type`, `options`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', NULL, 'minute', '4', 'true_false', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا', 1, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:07:05', '2018-09-04 14:07:05'),
	(2, 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', 'ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى ذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى', NULL, 'minute', '5', 'multi_choice', NULL, NULL, 1, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:08:10', '2018-09-04 14:08:10'),
	(3, 'هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ،', 'هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصًا بديلًا ومؤقتًا.', NULL, 'minute', '4', 'single_choice', 'لأنه مازال نصًا بديلًا ومؤقتًا.', 'لأنه مازال نصًا بديلًا ومؤقتًا.', 1, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:11:00', '2018-09-04 14:11:00'),
	(4, 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور', 'ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', NULL, 'minute', '10', 'single_choice', 'ه بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', 'ن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.', 1, 0, 0, 0, 0, 1, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:15:45', '2018-09-04 14:16:10');
/*!40000 ALTER TABLE `lms_questions` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_quizzes: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_quizzes` DISABLE KEYS */;
INSERT INTO `lms_quizzes` (`id`, `title`, `slug`, `meta_keywords`, `meta_description`, `content`, `duration`, `duration_unit`, `preview`, `price`, `sale_price`, `preview_video`, `pagination_questions`, `review_questions`, `is_standlone`, `is_featured`, `in_home`, `total_degree`, `passing_grade`, `retake_count`, `show_check_answer`, `skip_question`, `show_hint`, `allow_comments`, `status`, `published_at`, `private`, `type`, `options`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'اختبار علي الوحده الاولى', 'quiz-1baldj88rc9psyr4', NULL, NULL, NULL, NULL, 'minute', 0, 0.00, 0.00, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 0, 0, 0, NULL, '50', 1, 0, 0, 0, 0, 0, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 12:44:41', '2018-09-04 12:44:41'),
	(2, 'اختبار على الادب', 'quiz-1lattu10rn24qyw', NULL, NULL, NULL, NULL, 'minute', 0, 0.00, 0.00, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 0, 0, 0, '0', '50', 1, 0, 0, 0, 0, 0, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 12:45:50', '2018-09-04 13:37:25'),
	(3, 'اختبار عام علي الوحدتين', 'quiz-1c8xe0hvqu09r1yg', NULL, NULL, '<p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.<br />\r\nإذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.</p>', '5', 'minute', 0, 8.00, 8.00, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, 0, 0, '9', '50', 1, 0, 0, 1, 1, 1, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 12:46:03', '2018-09-04 14:09:09'),
	(4, 'اختبار لغة عربية', '654654', NULL, NULL, '<p>هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصًا بديلًا ومؤقتًا.</p>', '1', 'hour', 1, 0.00, 7.00, NULL, 1, 1, 1, 0, 0, '13', '50', 1, 1, 1, 1, 1, 1, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 13:39:22', '2018-09-04 14:11:41'),
	(5, 'اختبار تاريخ', '111sthb', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', '4', 'minute', 0, 5.00, 5.00, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, 0, 0, '13', '50', 1, 1, 0, 1, 0, 1, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:13:02', '2018-09-04 14:13:04'),
	(6, 'اختبار رياضيات', '65365', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.&nbsp;ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', '8', 'minute', 1, 21.00, 19.00, 'https://youtu.be/VdvEdMMtNMY', 0, 0, 1, 0, 0, '13', '50', 1, 0, 0, 1, 1, 1, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:14:29', '2018-09-04 14:14:31'),
	(7, 'اختباار عاااام', '643132', NULL, NULL, '<p>ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.&nbsp;ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملًا،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.</p>', NULL, 'minute', 1, 8.00, 6.00, NULL, 1, 1, 0, 0, 0, '23', '50', 1, 1, 1, 1, 1, 1, NULL, 0, 'standard', NULL, 1, 1, NULL, '2018-09-04 14:18:17', '2018-09-04 14:18:19');
/*!40000 ALTER TABLE `lms_quizzes` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_quiz_questions: ~15 rows (approximately)
/*!40000 ALTER TABLE `lms_quiz_questions` DISABLE KEYS */;
INSERT INTO `lms_quiz_questions` (`id`, `quiz_id`, `question_id`, `order`, `created_at`, `updated_at`) VALUES
	(1, 3, 1, 0, NULL, NULL),
	(2, 3, 2, 1, NULL, NULL),
	(3, 4, 2, 0, NULL, NULL),
	(4, 4, 1, 1, NULL, NULL),
	(5, 4, 3, 2, NULL, NULL),
	(6, 5, 2, 0, NULL, NULL),
	(7, 5, 1, 1, NULL, NULL),
	(8, 5, 3, 2, NULL, NULL),
	(9, 6, 2, 0, NULL, NULL),
	(10, 6, 3, 1, NULL, NULL),
	(11, 6, 1, 2, NULL, NULL),
	(12, 7, 2, 0, NULL, NULL),
	(13, 7, 1, 1, NULL, NULL),
	(14, 7, 3, 2, NULL, NULL),
	(15, 7, 4, 3, NULL, NULL);
/*!40000 ALTER TABLE `lms_quiz_questions` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_sectionables: ~9 rows (approximately)
/*!40000 ALTER TABLE `lms_sectionables` DISABLE KEYS */;
INSERT INTO `lms_sectionables` (`id`, `lms_sectionable_type`, `lms_sectionable_id`, `type`, `section_id`, `order`) VALUES
	(2, 'lesson', 3, 'lesson', 3, 0),
	(3, 'lesson', 5, 'lesson', 4, 0),
	(4, 'lesson', 2, 'lesson', 4, 1),
	(6, 'lesson', 4, 'lesson', 3, 1),
	(7, 'lesson', 2, 'lesson', 3, 2),
	(8, 'quiz', 6, 'quiz', 3, 3),
	(9, 'lesson', 1, 'lesson', 4, 2),
	(10, 'lesson', 3, 'lesson', 4, 3),
	(11, 'lesson', 6, 'lesson', 5, 0);
/*!40000 ALTER TABLE `lms_sectionables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_sections: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_sections` DISABLE KEYS */;
INSERT INTO `lms_sections` (`id`, `title`, `content`, `order`, `course_id`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'مقدمه في اللفه العربية', NULL, 0, NULL, 1, 1, NULL, '2018-09-04 12:41:20', '2018-09-04 12:41:20'),
	(2, 'دراسه الادب العربي', NULL, 0, NULL, 1, 1, NULL, '2018-09-04 12:42:43', '2018-09-04 12:42:43'),
	(3, 'مقدمه في اللغه العربية', NULL, 0, 2, 1, 1, NULL, '2018-09-04 13:13:55', '2018-09-04 13:16:48'),
	(4, 'دروس الادب المصري', NULL, 1, 2, 1, 1, NULL, '2018-09-04 13:14:23', '2018-09-04 13:16:49'),
	(5, 'الوحده الاولي', NULL, 0, 3, 1, 1, NULL, '2018-09-04 14:22:21', '2018-09-04 14:23:34'),
	(6, 'الوحده الاولي', NULL, 0, 4, 1, 1, NULL, '2018-09-04 14:24:58', '2018-09-04 14:25:44'),
	(7, 'الوحده التانيه', NULL, 0, NULL, 1, 1, NULL, '2018-09-04 14:43:10', '2018-09-04 14:43:10');
/*!40000 ALTER TABLE `lms_sections` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_subscriptions: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_subscriptions` DISABLE KEYS */;
INSERT INTO `lms_subscriptions` (`id`, `subscriptionnable_type`, `subscriptionnable_id`, `is_timable`, `finish_time`, `options`, `user_id`, `invoice_id`, `plan_id`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(7, 'plan', 1, 0, NULL, NULL, 1, 6, NULL, 1, 1, 1, '2018-09-05 23:44:09', '2018-09-05 23:44:09'),
	(8, 'plan', 2, 0, NULL, NULL, 1, 7, NULL, 0, 1, 1, '2018-09-05 23:55:01', '2018-09-05 23:55:01');
/*!40000 ALTER TABLE `lms_subscriptions` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_taggables: ~7 rows (approximately)
/*!40000 ALTER TABLE `lms_taggables` DISABLE KEYS */;
INSERT INTO `lms_taggables` (`lms_taggable_type`, `lms_taggable_id`, `tag_id`) VALUES
	('course', 2, 2),
	('course', 2, 1),
	('course', 3, 2),
	('course', 3, 1),
	('course', 4, 2),
	('lesson', 5, 2),
	('lesson', 3, 2);
/*!40000 ALTER TABLE `lms_taggables` ENABLE KEYS */;

-- Dumping data for table alrabeh.lms_tags: ~2 rows (approximately)
/*!40000 ALTER TABLE `lms_tags` DISABLE KEYS */;
INSERT INTO `lms_tags` (`id`, `name`, `slug`, `status`, `created_by`, `updated_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
	(1, 'س عربي', 'بقثسقبصث', 'active', NULL, NULL, NULL, '2018-09-04 16:20:22', '2018-09-04 16:20:24'),
	(2, 'س عامه', 'قبسيب', 'active', NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `lms_tags` ENABLE KEYS */;

-- Dumping data for table alrabeh.media: ~20 rows (approximately)
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `order_column`, `created_at`, `updated_at`) VALUES
	(1, 'course', 1, 'lms-course-thumbnail', '06', '06.jpg', 'image/jpeg', 'media', 4040, '[]', '{"root":"lms_demo"}', 1, '2018-09-04 12:53:04', '2018-09-04 12:53:04'),
	(2, 'category', 1, 'lms-category-thumbnail', 'mind', 'mind.png', 'image/png', 'media', 10160, '[]', '{"root":"lms_demo"}', 2, '2018-09-04 13:26:42', '2018-09-04 13:26:42'),
	(3, 'category', 2, 'lms-category-thumbnail', 'check', 'check.png', 'image/png', 'media', 5116, '[]', '{"root":"lms_demo"}', 3, '2018-09-04 13:27:21', '2018-09-04 13:27:21'),
	(4, 'category', 3, 'lms-category-thumbnail', 'bag', 'bag.png', 'image/png', 'media', 3917, '[]', '{"root":"lms_demo"}', 4, '2018-09-04 13:28:19', '2018-09-04 13:28:19'),
	(5, 'category', 4, 'lms-category-thumbnail', '1', '1.jpg', 'image/jpeg', 'media', 18874, '[]', '{"root":"lms_demo"}', 5, '2018-09-04 13:30:02', '2018-09-04 13:30:02'),
	(6, 'quiz', 4, 'lms-quiz-thumbnail', '05', '05.jpg', 'image/jpeg', 'media', 8278, '[]', '{"root":"lms_demo"}', 6, '2018-09-04 13:39:23', '2018-09-04 13:39:23'),
	(7, 'quiz', 3, 'lms-quiz-thumbnail', '03', '03.jpg', 'image/jpeg', 'media', 8464, '[]', '{"root":"lms_demo"}', 7, '2018-09-04 14:09:08', '2018-09-04 14:09:08'),
	(8, 'quiz', 5, 'lms-quiz-thumbnail', 'students', 'students.png', 'image/png', 'media', 7492, '[]', '{"root":"lms_demo"}', 8, '2018-09-04 14:13:03', '2018-09-04 14:13:03'),
	(9, 'quiz', 6, 'lms-quiz-thumbnail', '02', '02.jpg', 'image/jpeg', 'media', 6491, '[]', '{"root":"lms_demo"}', 9, '2018-09-04 14:14:30', '2018-09-04 14:14:30'),
	(10, 'quiz', 7, 'lms-quiz-thumbnail', 'teacher', 'teacher.png', 'image/png', 'media', 6550, '[]', '{"root":"lms_demo"}', 10, '2018-09-04 14:18:17', '2018-09-04 14:18:17'),
	(11, 'course', 2, 'lms-course-thumbnail', '02', '02.jpg', 'image/jpeg', 'media', 6491, '[]', '{"root":"lms_demo"}', 11, '2018-09-04 14:21:42', '2018-09-04 14:21:42'),
	(12, 'course', 3, 'lms-course-thumbnail', 'about', 'about.jpg', 'image/jpeg', 'media', 192308, '[]', '{"root":"lms_demo"}', 12, '2018-09-04 14:23:35', '2018-09-04 14:23:35'),
	(13, 'course', 4, 'lms-course-thumbnail', 'bag', 'bag.png', 'image/png', 'media', 3917, '[]', '{"root":"lms_demo"}', 13, '2018-09-04 14:25:45', '2018-09-04 14:25:45'),
	(14, 'plan', 2, 'lms-plan-thumbnail', '01', '01.jpg', 'image/jpeg', 'media', 6489, '[]', '{"root":"lms_demo"}', 14, '2018-09-04 14:34:43', '2018-09-04 14:34:43'),
	(15, 'plan', 3, 'lms-plan-thumbnail', 'students', 'students.png', 'image/png', 'media', 7492, '[]', '{"root":"lms_demo"}', 15, '2018-09-04 14:35:54', '2018-09-04 14:35:54'),
	(16, 'plan', 4, 'lms-plan-thumbnail', '06', '06.jpg', 'image/jpeg', 'media', 4040, '[]', '{"root":"lms_demo"}', 16, '2018-09-04 14:37:19', '2018-09-04 14:37:19'),
	(17, 'lesson', 5, 'lms-lesson-thumbnail', '06', '06.jpg', 'image/jpeg', 'media', 4040, '[]', '{"root":"lms_demo"}', 17, '2018-09-04 19:48:18', '2018-09-04 19:48:18'),
	(18, 'lesson', 4, 'lms-lesson-thumbnail', '03', '03.jpg', 'image/jpeg', 'media', 8464, '[]', '{"root":"lms_demo"}', 18, '2018-09-04 19:49:35', '2018-09-04 19:49:35'),
	(19, 'lesson', 3, 'lms-lesson-thumbnail', 'bag', 'bag.png', 'image/png', 'media', 3917, '[]', '{"root":"lms_demo"}', 19, '2018-09-04 19:50:20', '2018-09-04 19:50:20'),
	(20, 'lesson', 2, 'lms-lesson-thumbnail', 'mind', 'mind.png', 'image/png', 'media', 10160, '[]', '{"root":"lms_demo"}', 20, '2018-09-04 19:52:29', '2018-09-04 19:52:29');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
