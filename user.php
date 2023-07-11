<?php
class User
{
    public $inn,$okpo,$name,$okato_reg,
    $okato_fact,$okatmo_fact,$okved_osn,
    $okved_ne_osn,$okved_osn_fact,$okved_ne_osn_fact,
    $predp_type,$object_type,$nolog_type,$sum_workers,
    $viruchka,$okogu,$okvf,$okof,$size_kapital,
    $license,$okved2_license_type,$category_ermsp,
    $ermsp_date;

    public $answers = [];

    public function display()
    {
        echo $this->inn . $this->name;
        
        for($i = 0; $i < count($this->answers);$i++)
        {
            echo $this->answers[$i];
        }
    }

    public function check_answer($id,$arg)
    {
        $this->answers[$id] = $arg;
    }
}

?>