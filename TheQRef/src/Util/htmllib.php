<?php



function create_doctype(): void{
    echo "<!doctype html>";
}

function begin_html(): void{
    echo "<html>";
}

function end_html(): void{
    echo "</html>";
}

function begin_head(): void{
    echo "<head>";
}

function end_head(): void{
    echo "</head>";
}

function begin_body(array $params = []): void {
    $ispis = "<body";
    foreach($params as $kljuc => $vrijednost){
        $ispis = $ispis ." " .$kljuc ."='" .$vrijednost."'";
    }
    $ispis = $ispis .">";
    echo $ispis;
}

function end_body(): void{
    echo "</body>";
}

function create_table(array $params): void{
    $ispis = "<table";
    foreach($params as $kljuc => $vrijednost){
        $ispis = $ispis ." " .$kljuc ."='" .$vrijednost."'";
    }
    $ispis = $ispis .">";
    echo $ispis;
}

function end_table(): void{
    echo "</table>";
}


function create_element(string $name, bool $closed, array $params): string {
    $povrat = "";
    $povrat = $povrat . "<" . $name ." ";
    foreach ($params as $key => $value) {
        if ($key != "contents") {
            $povrat = $povrat .$key ."='" .$value ."' ";
        }
        if($key == "contents") {
            $povrat = $povrat .">" . $value;
        }
    }
    if($closed) {
        $povrat = $povrat ."</" . $name . ">";
    }
    return $povrat;
}

function create_table_cell(array $params): string{
    return create_element("td",true,$params);
}

function create_table_row(array $params): string {
    $povrat = "<tr";
    foreach ($params as $key => $value) {
        if($key != "contents") {
            $povrat = $povrat .$key ."='" .$value ."' ";
        }
        if($key == "contents") {
            $povrat = $povrat . ">";
            foreach ($value as $value1) {
                $povrat = $povrat .$value1;
            }
        }
        $povrat = $povrat . "</tr>";
    }

    return $povrat;
}



//***********************************************************
    function start_form($action, $method) {
        $povrat = "<form " ."method ='" .$method ."' action='" .$action ."'>";
        echo $povrat;
    }

    function end_form() {
        echo "</form>";
    }

    function create_input(array $params): string {
        $povrat = "<input";
        foreach ($params as $key => $value) {
            $povrat = $povrat ." " .$key ."='" .$value ."'";
        }
        $povrat = $povrat .">";
        return $povrat;
    }

    function create_select(array $params): string {
        $povrat = "<select";
        foreach ($params as $key=>$value) {
            if($key != "contents") {
                $povrat = $povrat ." " .$key ."='" .$value ."'";
            }
            if($key == "contents") {
                $povrat = $povrat .">";
                foreach ($value as $value1) {
                    $povrat = $povrat .$value1;
                }
            }
        }
        $povrat = $povrat ."</select>";
        return $povrat;
    }

    function create_button (array $params ): string {
        $povrat = "<button";
        foreach ($params as $key => $value) {
            if($key != "contents") {
                $povrat = $povrat ." " .$key ."='" .$value ."'";
            }
            if($key == "contents") {
                $povrat = $povrat .">";
                $povrat = $povrat .$value;
            }
        }
        $povrat = $povrat ."</button>";
        return $povrat;
    }