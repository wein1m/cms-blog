<?php
require_once "../head.php";
require_once "../helpers/db.php";

$tags = db_fetch_all("SELECT * FROM tag");
$categories = db_fetch_all("SELECT * FROM kategori");
?>

<link rel="stylesheet" href="../quill.css">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<section id="form">
    <form action="create.php" method="POST" id="new-story">
        <input type="text" name="title" placeholder="Untitled Article"
            class="w-full text-5xl font-bold placeholder:text-black/30 overflow-x-visible!">
        <div class="mt-12 lg:mb-20 mb-14">
            <h5 class="text-lg font-semibold">Thumbnail</h5>
            <div class="-mt-4">
                <input type="text" id="img_url" name="img_url" placeholder="Paste image URL..."
                    class="w-full mt-3 bg-transparent border-b border-black/20 py-2">
                <div id="img-container"> </div>
            </div>
        </div>

        <!-- Quill Container -->
        <h5 class="text-lg font-semibold">Contents</h5>
        <div id="editor">
            <div id="editor-container" class="text-9xl"></div>
        </div>

        <div class="mt-10">
            <h5 class="mb-2 text-lg font-semibold">Select Category:</h5>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($categories as $cat): ?>
                <button type="button" data-cat-id="<?= $cat['id'] ?>"
                    class="category pill">
                    <?= $cat["name"] ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-8">
            <h5 class="mb-2 text-lg font-semibold">Select Category:</h5>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($tags as $tag): ?>
                <button type="button" data-tag-id="<?= $tag['id'] ?>"
                    class="tag pill">
                    # <?= $tag["name"] ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="flex justify-end w-full mt-14 lg:mt-20">
            <button type="submit" class="btn-primary">
                Submit
            </button>
        </div>

        <!-- <input type="hidden" name="title" id="title-input">
        <input type="hidden" name="img_cover" id="img-input"> -->
        <input type="hidden" name="content" id="content-input">
        <input type="hidden" name="category" id="category-input">
        <input type="hidden" name="tags" id="tags-input">
    </form>
</section>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="/cms-blog/assets/js/story-form.js"></script>

<?php
include_once "../foot.php";
?>
