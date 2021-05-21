<?php

namespace controller;

abstract class AbstractController {

    public function doAction() {
        global $CONTENTS;

        create_doctype();
        begin_html();

        begin_head();
        end_head();

        begin_body();

        $this->doJob();

        end_body();
        end_html();
    }

    protected abstract function doJob();
}
