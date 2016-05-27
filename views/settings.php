<?php $view->script('settings', 'pagekitlogger:app/bundle/settings.bundle.js', ['vue', 'uikit-tooltip']); ?>
<?php $view->style('settings-css', 'pagekitlogger:app/assets/styles/settings.css'); ?>

<div id="pagekit-logger-settings" class="uk-grid">
    <settings></settings>
</div>