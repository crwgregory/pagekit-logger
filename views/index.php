<?php $view->script('index', 'pagekitlogger:app/bundle/index.bundle.js', ['vue', 'uikit-offcanvas']); ?>
<?php $view->style('analyze-css', 'pagekitlogger:app/assets/styles/index.css'); ?>

<div id="pagekit-logger-index" class="uk-grid">
    <div v-if="hasExceptions" class="uk-width-1-1">
        <log-exception :exceptions="exceptions"></log-exception>
    </div>
</div>