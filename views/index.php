<?php $view->script('index', 'pagekitlogger:app/bundle/index.bundle.js', ['vue', 'uikit-modal']); ?>
<?php $view->style('analyze-css', 'pagekitlogger:app/assets/styles/index.css'); ?>

<div id="pagekit-logger-index" class="uk-grid">

    <div class="uk-width-1-1">
        <log-exception v-if="hasExceptions" :exceptions="exceptions"></log-exception>
    </div>

    <div class="uk-width-1-1">
        <log-message v-if="hasExceptions" :messages="messages"></log-message>
    </div>
</div>