<?php $view->script('index', 'pagekitlogger:app/bundle/index.bundle.js', ['vue', 'uikit-tooltip']); ?>
<?php $view->style('analyze-css', 'pagekitlogger:app/assets/styles/index.css'); ?>

<div id="pagekit-logger-index">
    <index-component :logs="logs"></index-component>
</div>