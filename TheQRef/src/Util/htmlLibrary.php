<?php

abstract class HTMLNode {
    public abstract function get_html();
}

abstract class HTMLElement extends HTMLNode {
    protected  $attributes;
    protected $children;
    protected $closed;
    protected $name;

    public function __construct($name,$closed = true) {
        $this->closed = $closed;
        $this->name = $name;
        $this->attributes = [];
        $this->children = new HTMLCollection();
    }

    public function add_child(HTMLNode $node): int {
        ($this->children)->add($node);
        return ($this->children)->size();

    }

    public function add_children(HTMLCollection $collection) {
        $this->children = $collection;
    }

    public function get_child ( $position ) {
        $cvorovi = $this->children->get_html_collection();
        return $cvorovi[$position];
    }

    public function remove_child ( $position ) {
        $cvorovi = $this->children->get_html_collection();
        unset($cvorovi,$position);
    }

    public function get_children_number ():int {
        $cvorovi = $this->children->get_html_collection();
        return $cvorovi->size();
    }

    public function add_attribute ( HTMLAttribute $attribute ) {
        array_push($this->attributes,$attribute);
    }

    public function remove_attribute ( $attribute ) {
        $position = 0;
        foreach ($this->attributes as $atr) {
            if($atr == $attribute) {
                unset($this->attributes[$position]);
                $position++;
            }
        }
    }

    public function get_name () {
        return $this -> name ;
    }

    public function __toString () {
        return $this -> get_html ();
    }

    protected function get_head_tag () :string{
// TODO
    }

    protected function get_tail_tag () {
// TODO
    }

    public function get_html () {
        $povrat = "<" .$this->name;
        foreach ($this->attributes as $atribut) {
            $povrat = $povrat ." " .$atribut->__toString();
        }
        if($this->closed) {
            $povrat = $povrat . ">" . (($this->children)->get_html_collection());
            $povrat = $povrat . "</" . $this->name . ">";
        }
        else {
            $povrat = $povrat ." " .(($this->children)->get_html_collection()) . ">";
        }
        return $povrat;
    }

}

class HTMLCollection {
    private $nodes;

    public function __construct($nodes = []) {
        $this->nodes = $nodes;
    }

    public function add(HTMLNode $node): int {
        array_push($this->nodes,$node);
        return count($this->nodes);
    }

    public function get($position) {
        return $this->nodes[$position];
    }

    public function get_all () :array{
        return $this -> nodes ;
    }

    public function size () :int{
        return sizeof ($this -> nodes );
    }

    public function delete($position) {
        unset($this->nodes[$position]);
    }

    public function get_html_collection() {
        $nodes = "";
        foreach ($this -> nodes as $node ) {
            $nodes .= $node -> get_html ();
        }
        return $nodes ;
    }
}


class HTMLAttribute {

    private $name ;
    private $value = [];

    public function __construct ($name , $value ) {
        $this -> name = $name ;
        array_push($this -> value, $value) ;
    }

    public function add_value ( $value ) {
        $mozemoDodati = true;
        foreach ( ((array)($this->value)) as $vr) {
            if($vr == $value) {
                $mozemoDodati = false;
            }
        }
        if($mozemoDodati) {
            array_push($this->value, $value);
        }
    }

    public function add_values ( $values ) {
        foreach ($values as $value) {
            $mozemoDodati = true;
            foreach ($this->value as $vr) {
                if($vr == $value) {
                    $mozemoDodati = false;
                }
            }
            if($mozemoDodati) {
                array_push($this->value,$value);
            }
        }
    }

    public function remove_value ($value) :void{
        $position = 0;
        foreach ((array)$this->value as $vr) {
            if($vr == $value) {
                unset($this->value[$position]);
            }
            $position++;
        }
    }

    public function get_name () {
        return $this -> name ;
    }

    public function get_values (): string {
        $povrat = "";
        foreach((array)$this->value as $vrijednosti) {
            $povrat = $povrat .$vrijednosti;
        }
        return $povrat;
    }

    public function __toString () {
        return $this->name ." = '" .$this->get_values()."'";
    }
}

class HTMLTextNode extends HTMLNode {

    private $text ;

    public function __construct ( $text ) {
        $this -> text = $text ;
    }

    public function get_text () {
        return $this -> text ;
    }

    public function __toString () {
        return $this -> text ;
    }

    public function get_html () {
        return $this -> get_text ();
    }
}


class HTMLHtmlElement extends HTMLElement {

    public function __construct() {
        parent:: __construct("html",true);
    }

    public function get_html () {
        $html = " <! doctype  html >";
        //   $html .= $this -> get_head_tag ();
        $html .= $this -> children -> get_html_collection ();
        //   $html .= $this -> get_tail_tag ();
        return $html ;
    }
}

class HTMLHeadElement extends HTMLElement {
    public function __construct () {
        parent :: __construct ("head", true );
    }
}

class HTMLBodyElement extends HTMLElement
{
    public function __construct()
    {
        parent::__construct("body", true);
    }
}
class HTMLTitleElement extends HTMLElement {

    public function __construct($title) {
        parent::__construct("title",true);
        $this->add_child(new HTMLTextNode($title));
    }
}

class HTMLMetaElement extends HTMLElement {

    public function __construct($charset) {
        parent::__construct("meta",false);
        $this->add_child(new HTMLTextNode($charset));
    }
}

class HTMLDivElement extends HTMLElement {
    public function __construct() {
        parent::__construct("div",true);
    }
}

class HTMLPElement extends HTMLElement {
    public function __construct() {
        parent::__construct("p",true);
    }
}

class HTMLAElement extends HTMLElement {

    public function __construct($link, $text) {
        parent::__construct("a",true);
        $this->add_attribute(new HTMLAttribute("href",$link));
        $this->add_child(new HTMLTextNode($text));
    }
}

class HTMLTextAreaElement extends HTMLElement {
    public function __construct() {
        parent::__construct("textarea",true);
    }
}

// TABLICE
class  HTMLTableElement extends HTMLElement {
    public function __construct() {
        parent::__construct("table",true);
    }

    public function add_row(HTMLRowElement $row = null) {
        $this->add_child($row);
    }

    public function add_rows($rows = []) {
        foreach ($rows as $redak) {
            $this->add_child($redak);
        }
    }

    public function remove_row($position) {
        $this->remove_child($position);
    }


}

class HTMLRowElement extends HTMLElement {
    public function __construct($cellArray = null) {
        parent::__construct("tr",true);
        $this->add_children(new HTMLCollection($cellArray));

    }

    public function add_cell($cell) {
        $this->add_child($cell);
    }

    public function add_cells($cells = []) {
        foreach ($cells as $celija) {
            $this->add_child($celija);
        }
    }

    public function remove_cell($position) {
        $this->remove_child($position);
    }
}

class HTMLCellElement extends HTMLElement {

    public function __construct ($elem = null) {
        parent::__construct("td",true);
        $this->add_child(new HTMLTextNode($elem));
    }
}

//TABLICE


class HTMLFormElement extends HTMLElement{
    public function __construct()
    {
        parent::__construct("form", true);
    }
}

class HTMLInputElement extends HTMLElement{
    public function __construct() {
        parent::__construct("input", false);
    }
}

class HTMLButtonElement extends HTMLElement {
    public function __construct () {
        parent::__construct("button", true);
    }
}

class HTMLSelectElement extends HTMLElement {
    public function __construct () {
        parent::__construct("select",true);
    }
}

class HTMLOptionElement extends HTMLElement {
    public function __construct () {
        parent::__construct("option",true);
    }
}

class HTMLImgElement extends HTMLElement {
    public function __construct() {
        parent::__construct("img","false");
    }
}

class HTMLHrElement extends HTMLElement {
    public function __construct() {
        parent::__construct("hr","false");
    }
}

class HTMLLabelElement extends HTMLElement {
    public function __construct() {
        parent::__construct("label","true");
    }
}

