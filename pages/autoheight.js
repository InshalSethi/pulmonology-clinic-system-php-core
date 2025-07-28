
     var txt = $('#hpia'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
 var txt = $('#family_history'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
var txt = $('#hpi'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
var txt = $('#per_history'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
var txt = $('#impression'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
