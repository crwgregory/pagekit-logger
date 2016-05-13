<?php $view->script('settings', 'pagekitlogger:app/bundle/settings.bundle.js', ['vue', 'uikit-tooltip']); ?>
<?php $view->style('settings-css', 'pagekitlogger:app/assets/styles/settings.css'); ?>

<div id="pagekit-logger-settings" class="uk-grid">
    <div v-if="hasExceptions" class="uk-width-1-1">
        Hello
    </div>
</div>