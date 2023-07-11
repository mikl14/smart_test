<?php
session_start();
require_once('../php/connect_base_sql.php');
//print_r($_POST);
if(!$GLOBALS['max_group'])
{
  $GLOBALS['max_group'] = (get_custom_query("SELECT MAX(grp) FROM questions")[0]['max']);
}

if($_POST['navig']==1) {
  $_SESSION['i']++;
  $_SESSION['question_user']++;
}
elseif ($_POST['navig']==-1) {
  $_SESSION['i']--;
  $_SESSION['question_user']--;
}
else
{
  $_SESSION['i'] = 1;
  $_SESSION['question_user'] = 1;
}

check_answers();
$GLOBALS['current_questions'] = get_custom_query("SELECT * FROM questions WHERE grp={$_SESSION['i']} ORDER BY grp_id");
while(!$GLOBALS['current_questions']) 
{
  $_SESSION['i']+=$_POST['navig'];
  $GLOBALS['current_questions'] = get_custom_query("SELECT * FROM questions WHERE grp={$_SESSION['i']} ORDER BY grp_id");
}
if ($_SESSION['i']!=$GLOBALS['max_group'])
{
  echo "<span>Вопрос №{$_SESSION["question_user"]}</span>";
}
    foreach ($GLOBALS['current_questions'] as $question) {
      switch ($question["type"]){
      case '0':
        //проверка на конец
        if ($_SESSION['i']!=$GLOBALS['max_group']) {
          // заголовок
          echo "<div class='zag'>{$question["question"]}</div>"; 
        }
        else
        {
          echo "<span style='text-align:center'>{$question["question"]}</span>";
        }
        //проверка для фондов
        if ($question["question"]=="Основные фонды организации") {
          echo "<div class='fond'>";
          echo "<div>Виды основных фондов</div>";
          echo "<div>Наличие основных фондов на конец года <b>по полной учетной стоимости, тыс. руб.</b></div>";
          echo "<div>Наличие основных фондов на конец года <b>по остаточной балансовой стоимости, тыс. руб.</b></div>";
          echo "</div>";
        }
        break;
      case '1':
        // да/нет с описанием
        echo "<div class='big_q'>{$question['question']}</div>";
        echo "<div class='desc'>{$question['description']}</div>";
        echo "<div class='radio'>";
        echo "<div class='input-radio'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question["grp"]}{$question["grp_id"]}1' value='Да'><label for='{$question["grp"]}{$question["grp_id"]}1'>Да</label></div>";
        echo "<div class='input-radio'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question["grp"]}{$question["grp_id"]}2' value='Нет'><label for='{$question["grp"]}{$question["grp_id"]}2'>Нет</label></div>";
        echo "</div>";
        break;
      case '2':
        // блок да/нет
        echo "<div class='big_q'>{$question['question']}</div>";
        echo "<div class='radio'>";
        echo "<div class='input-radio'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question["grp"]}{$question["grp_id"]}1' value='Да'><label for='{$question["grp"]}{$question["grp_id"]}1'>Да</label></div>";
        echo "<div class='input-radio'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question["grp"]}{$question["grp_id"]}2' value='Нет'><label for='{$question["grp"]}{$question["grp_id"]}2'>Нет</label></div>";
        echo "</div>";
        break;
      case '3':
        //особый блок для фондов
        echo "<div class='fond_q'><div>{$question['question']}</div><div><input type='number' step='any' name='{$question["grp"]}{$question["grp_id"]}1'></div><div><input type='number' step='any' name='{$question["grp"]}{$question["grp_id"]}2'></div></div>";
        break;
      case '4':
        echo "<div class='small_q'>{$question['question']}</div><textarea name='{$question['grp']}{$question['grp_id']}'></textarea>";
        break;
      case '5':
      //выпадающий список (отдых)
                switch ($question['description']) {
                  case 1:
                    echo "<div class='small_q'>{$question['question']}</div>";
                    echo "<div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}1'><label for='{$question['grp']}{$question['grp_id']}1'>Гостиницы и аналогичные средства размещения</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}2'><label for='{$question['grp']}{$question['grp_id']}2'>Специализированные средства размещения</label></div>";            
                    echo "</div><br>";
                    break;
                  case 2:
                    echo "<div id='gostinic'>";
                    echo "<div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}1'><label for='{$question['grp']}{$question['grp_id']}1'>Гостиница</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}2'><label for='{$question['grp']}{$question['grp_id']}2'>Мотель</label></div>";
                    echo "</div><div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}3'><label for='{$question['grp']}{$question['grp_id']}3'>Хостел</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}4'><label for='{$question['grp']}{$question['grp_id']}4'>Другая организация  гостиничного типа</label></div>";
                    echo "</div></div>";

                    echo "<div id='specsred'>";
                    echo "<div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}5'><label for='{$question['grp']}{$question['grp_id']}5'>Санаторно-курортные организации</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}6'><label for='{$question['grp']}{$question['grp_id']}6'>Организации отдыха</label></div>";
                    echo "</div></div>";
                    echo "<br>";
                    break;
                  case 3:
                    echo "<input type='radio' name='{$question["grp"]}{$question["grp_id"]}' style='display:none' id='{$question['grp']}{$question['grp_id']}0'><label style='display:none' for='{$question['grp']}{$question['grp_id']}0'>NaN</label>";
                    echo "<div id='sanatorno'>";
                    echo "<div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}1'><label for='{$question['grp']}{$question['grp_id']}1'>Санаторий</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}2'><label for='{$question['grp']}{$question['grp_id']}2'>Санаторий для детей</label></div>";
                    echo "</div><div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}3'><label for='{$question['grp']}{$question['grp_id']}3'>Санаторий для детей с родителями</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}4'><label for='{$question['grp']}{$question['grp_id']}4'>Санаторный оздоровительный лагерь</label></div>";
                    echo "</div><div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}5'><label for='{$question['grp']}{$question['grp_id']}5'>Санаторий-профилакторий</label></div>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}6'><label for='{$question['grp']}{$question['grp_id']}6'>Курортная поликлиника, бальнеологическая лечебница</label></div>";
                      echo "</div><div class='flex-container-around'>";
                      echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}7'><label for='{$question['grp']}{$question['grp_id']}7'>Грязелечебница</label></div>";
                    echo "</div></div>";

                    echo "<div id='orgotd'>";
                    echo "<div class='flex-container-around'>";
                    echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}8'><label for='{$question['grp']}{$question['grp_id']}8'>Дом отдыха</label></div>";
                    echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}9'><label for='{$question['grp']}{$question['grp_id']}9'>Пансионат</label></div>";
                    echo "</div><div class='flex-container-around'>";
                    echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}10'><label for='{$question['grp']}{$question['grp_id']}10'>Кемпинг</label></div>";
                    echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}11'><label for='{$question['grp']}{$question['grp_id']}11'>База отдыха, туристская база, другая организация отдыха</label></div>";
                    echo "</div></div>";
                    break;
                  default:
                    break;
                }
          break;
        case '6':
          //выпадающий список (список в описании по разделителю |)
          echo "<div class='small_q'>{$question['question']}</div>";
          $spisok = explode("|", $question['description']);
          $i=0;
          echo "<div class='flex-container-around'>";
          foreach ($spisok as $value) {
            echo "<div class='input-radio type51'><input type='radio' name='{$question["grp"]}{$question["grp_id"]}' id='{$question['grp']}{$question['grp_id']}{$i}'><label for='{$question['grp']}{$question['grp_id']}{$i}'>{$value}</label></div>";
            $i++;
            if ($i%2 == 0 && $i!=count($spisok)) {
              echo "</div><div class='flex-container-around'>";
            }
          }
            echo "</div>";
          break;
        break;
      default:
        break;
      }
    }
    echo "<div class='backdalee'>";
    echo "<input type='hidden' id='navig' name='navig'>";
    if($_SESSION['i']!=1) echo "<button id='back'>Назад</button>";
    if($_SESSION['i']!=$GLOBALS['max_group']) echo "<button id='next'>Далее</button>";
    else echo "<button id='end'>Завершить</button>";
    echo "</div>";

    function check_answers()
    {
      switch ($_SESSION['i']) {
        case '2':
          if($_POST['11']!='Да'){
            $_SESSION['i']+=$_POST['navig'];
            check_answers();
          }
          break;
        case '3':
          if($_POST['11']!='Нет'){
            $_SESSION['i']+=$_POST['navig'];
            check_answers();
          }
          break;
        case '4':
          if($_POST['31']!='Да'){
            $_SESSION['i']+=$_POST['navig'];
            check_answers();
          }
          break;
        case '5':
          if($_POST['25']!='Да'){
            $_SESSION['i']+=$_POST['navig'];
            check_answers();
          }
          break;
        case '6':
        if($_POST['26']!='Да'){
          $_SESSION['i']+=$_POST['navig'];
          check_answers();
        }
        break;
        case '7':
          if($_POST['27']!='Да'){
            $_SESSION['i']+=$_POST['navig'];
            check_answers();
          }
          break;
        default:
          // code...
          break;
      }
    }
?>