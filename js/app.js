$(document).on('submit', '[data-toggle="new-comment"]', function (event) {
    // Disable default behaviour for form submit
    event.preventDefault();
    var form = this;
    var target = form.dataset.target;
    var url = form.dataset.url;
    var $form = $(form);
    $form.find('.is-invalid').removeClass('is-invalid');

    $.post(url, $form.serialize(), function (response) {
        if (typeof response.comment !== 'undefined') {
            $(target).before(response.comment);
            $('[data-toggle="comment-count"]').each(function () {
                var $element = $(this);
                $element.text(+ $element.text() + 1);
            });
            form.reset();
            $form.closest('.collapse.show').collapse('hide');
        } else if (typeof response.error !== 'undefined') {
            for (var key in response.error) {
                // skip loop if the property is from prototype
                if (!response.error.hasOwnProperty(key)) continue;

                var error = response.error[key];
                var $input = $form.find('[name="' + key + '"]');
                $input.addClass('is-invalid');
                $input.next('.invalid-feedback').text(error);
            }

        }
    });
});


$(document).on('click', '[data-toggle="reply"]', function (event) {
    var commentId = this.dataset.comment;
    var $parent = $(this).closest(this.dataset.parent);
    var $collapse = $parent.next('.collapse');
    $parent.parent().find('.collapse').collapse('hide');
    $collapse.find('.is-invalid').removeClass('is-invalid');
    $collapse.find('.invalid-feedback').text('');
    if ($collapse.length > 0 && $collapse.hasClass('show')) {
        $collapse.collapse('hide');
    } else {
        if ($collapse.length === 0) {
            $collapse = $('<div class="collapse"></div>');
            var $subComment = $('#newComment').clone();
            $subComment.attr('id', null);
            $subComment.addClass('ml-5');
            $subComment.attr('data-target', '#commentList .collapse.show + .alert');
            $subComment.append('<input type="hidden" name="parent_id" value="' + commentId +'">');
            $subComment.find('.is-invalid').removeClass('is-invalid');
            $collapse.append($subComment);
            $parent.after($collapse);
        }
        $collapse.collapse('show');
    }
});