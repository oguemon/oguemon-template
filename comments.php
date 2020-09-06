<?php
// コメントフォームのオプション
$comment_form_options = [
    'label_submit'         => 'コメント',
    'title_reply'          => '',
    'reply_text_to'        => '%s への返信',
    'cancel_reply_link'    => 'キャンセル',
    'comment_notes_before' => '',
    'comment_notes_after'  => '',
    'comment_field'        => '<textarea id="comment-input" name="comment" placeholder="コメントを入力…"></textarea>',
    'fields'               => apply_filters('comment_form_default_fields', [
        'author' => '<input type="text" name="author" placeholder="名前" required />'
    ])
];

// コメントリストの表示処理
function demo_comment_format($comment, $args, $depth) {
    $avatar_size = ($depth == 1)? 48 : 36;
    $child = ($depth == 1)? '' : 'child';

    echo '<div class="comment-item">';
    echo    get_avatar($comment, $avatar_size);
    echo    '<div class="body ' . $child . '">';
    echo        '<div class="meta">';
    echo            '<span class="author-name">' . get_comment_author() . '</span>';
    echo            '<span class="date">' . get_comment_date() . '</span>';
    echo        '</div>';
    echo        '<div class="text">' . nl2br(get_comment_text()) . '</div>';
    echo        '<div class="reply">';
    echo            get_comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => 2]));
    echo        '</div>';
    echo    '</div>';
    echo '</div>';
}

// コメントリストのオプション
$comment_list_options = [
    'callback'   => 'demo_comment_format',
    'reply_text' => '返信する',
];

// コメント可能ならば
if(comments_open(get_the_ID())) {
?>
    <div class="comments">
        <div class="header"><i class="comment-icon"></i><?= get_comments_number(); ?>件のコメント</div>
        <?php comment_form($comment_form_options); ?>
        <div id="comment-toggle">コメントの一覧を開閉する</div>
        <div id="comment-list" style="display: none;">
            <?php wp_list_comments($comment_list_options); ?>
        </div>
    </div>
<?php
}
