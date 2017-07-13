(function($) {
    $(document).ready(function () {
        $(document).on('click', '.js-show-point', function () {
            var $tr = $(this).closest('tr');

            if (!$(this).data('show')) {
                for (var i = 0; i < $tr.parent().find('tr').length; i++) {
                    $tr = $tr.next();
                    if ($tr.is(':visible')) {
                        break;
                    }
                    else $tr.show();
                }

                $(this).removeClass('glyphicon-chevron-right');
                $(this).addClass('glyphicon-chevron-down');
                $(this).data('show', true);
            }
            else {
                for (var i = 0; i < $tr.parent().find('tr').length; i++) {
                    $tr = $tr.next();
                    if ($tr.data('lvl') != 0) {
                        $tr.hide();
                    }
                    else break;
                }

                $(this).removeClass('glyphicon-chevron-down');
                $(this).addClass('glyphicon-chevron-right');
                $(this).data('show', false);
            }
            return false;
        });

        // Fix для виджета с выплатами. Считаем сумма по столбцам исключая повторения.
        if ($('.js-recalc-sum').length) {
            $('.js-recalc-sum').each(function(index) {
                index += 3;
                var sum = 0;
                var income = 0;
                var expense = 0;
                $(this).closest('table').find('[data-lvl="0"] td:nth-child(' + index + ')').each(function() {
                    if ($(this).closest('tr').data('id') == 65) {
                        income += parseFloat($(this).data('val'));
                    }
                    else {
                        expense += parseFloat($(this).data('val'));
                    }
                    sum += parseFloat($(this).data('val'));
                });


                var html = '';
                //html += '<span class="text-success">' + getCurrency(income) + '</span>';
                html += '<span class="text-danger">' + getCurrency(expense) + '</span>';
                html += '<br>' + getCurrency(sum);

                $(this).html(html);
            });
        }
    });

    function getCurrency(sum) {
        sum = (Math.round(sum * 100) / 100).toString();

        if (sum.indexOf('.') === -1) {
            sum += ',00';
        }
        else {
            sum = sum.replace(/\./g, ',');
        }
        return sum.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ') + ' руб.';
    }

}) (jQuery);