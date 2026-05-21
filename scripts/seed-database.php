<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Lib\Database;

$pdo = Database::getConnection();

echo "Clearing old data...\n";

$pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
$pdo->exec("TRUNCATE TABLE article_category");
$pdo->exec("TRUNCATE TABLE articles");
$pdo->exec("TRUNCATE TABLE categories");
$pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

echo "Seeding categories...\n";

$categories = [
    [
        "name" => "Tech",
        "slug" => "tech",
        "description" => "Tech news and tutorials",
    ],
    [
        "name" => "Design",
        "slug" => "design",
        "description" => "UI/UX and creative design",
    ],
    [
        "name" => "Business",
        "slug" => "business",
        "description" => "Startup and business insights",
    ],
    [
        "name" => "Health",
        "slug" => "health",
        "description" => "Health and wellness articles",
    ],
    [
        "name" => "Sports",
        "slug" => "sports",
        "description" => "Sports news and updates",
    ],
];

$categoryStatement = $pdo->prepare(
    "INSERT INTO categories (name, slug, description) VALUES (?, ?, ?)"
);

$categoryIds = [];

foreach ($categories as $category) {
    $categoryStatement->execute([
        $category["name"],
        $category["slug"],
        $category["description"],
    ]);

    $categoryIds[$category["slug"]] = $pdo->lastInsertId();
}

echo "Seeding articles...\n";

$articleStatement = $pdo->prepare("
    INSERT INTO articles (
        title,
        slug,
        excerpt,
        content,
        image,
        views,
        status,
        published_at,
        created_at
    )
    VALUES (?, ?, ?, ?, ?, ?, 'published', NOW(), NOW())
");

$linkStatement = $pdo->prepare("
    INSERT INTO article_category (article_id, category_id)
    VALUES (?, ?)
");

foreach ($categories as $category) {
    $categorySlug = $category["slug"];
    $categoryId = $categoryIds[$categorySlug];

    for ($i = 1; $i <= 10; $i++) {
        $title = ucfirst($categorySlug) . " Article {$i}";

        $articleStatement->execute([
            $title,
            $categorySlug . "-article-" . $i,
            "Short excerpt for {$title}.",
            "Full content for {$title}. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
            "https://picsum.photos/seed/" . uniqid() . "/800/400",
            rand(0, 1000),
        ]);

        $articleId = $pdo->lastInsertId();

        $linkStatement->execute([$articleId, $categoryId]);
    }
}

echo "Done database seeding!\n";
