<?php
/*
 * Classe HTML
 * 
 * Insere tags HTML
 *
 *
*/
abstract class HTML {
    /**
     * Inicia um formulário
     * @param String $action
     * @param String $method
     * @param String $enctype
     * @param String $onsubmit Função a ser executada ao enviar os dados
     */
    public static function startForm($action,
                    $method="get",
                    $enctype="application/x-www-form-urlencoded",
                    $onsubmit=""){
        echo '<form action="'.$action.'" method="'.$method.'" enctype="'.$enctype.'"  onsubmit="'.$onsubmit.'">';
    }
    /**
     * Fecha um formulário
     */
    public static function closeForm(){
        echo '</form>';
    }
    /**
     * Inicia uma lista SELECT
     * @param String $name
     * @param String $class
     * @param String $style
     */
    public static function startSelect($name="",$class="",$style=""){
        if ($class!="") $class='class="'.$class.'"';
        if ($style!="") $style='style="'.$style.'"';
        echo '<select name="'.$name.'" '. "$class $style >";
    }
    /**
     * Fecha uma lista SELECT
     */
    public static function closeSelect(){
        echo '</select>';
    }
    /**
     * Insere uma opção da lista SELECT
     * @param String $value
     * @param String $friendlyName
     */
    public static function selectInsertNewOption($value,$friendlyName="",$defaultValue=false){
        if ($defaultValue==true) $df=' selected="selected "';
        echo "<option value=\"$value\" $df >$friendlyName</option>";
    }
    /**
     * Inicia um campo FIELDSET
     * @param String $legend
     * @param String $id
     * @param String $class
     * @param String $style
     */
    public static function startFieldSet($legend,$id="",$class="",$style=""){
        if ($id!="") $id='id="'.$id.'"';
        if ($class!="") $class='class="'.$class.'"';
        if ($style!="") $style='style="'.$style.'"';
        echo "<fieldset $id $class $style><legend>$legend</legend>";
        //echo "<div $id $class $style><strong>$legend</strong>";

    }
    /**
     * Fecha um campo FIELDSET
     */
    public static function closeFieldSet(){
        echo '</fieldset>';
        //echo '</div>';

    }
    /**
     * Retorna um link formatado de um e-mail
     * @param String $email
     * @param String $text
     * @return String E-mail formatado
     */
    public static function createlinkEmail($email,$text) {
        return HTML::createLink("mailto:$email",$text);
    }
    /**
     * Retorna uma tag formatada de imagem
     * @param String $url_imagem
     * @param String $alternative_text
     * @param String $style
     * @return String Tag de imagem
     */
    public static function createImgTag($url_imagem,$alternative_text,$style="",$class="") {
        if($style!="")$style="style=\"$style\" ";
        if($class!="")$class="class=\"$class\" ";

        return '<img src='.$url_imagem.' alt="'.$alternative_text.'" '.$style.$class.'  />';
    }
    /**
     * Retorna um link formatado
     * @param String $url
     * @param String $text
     * @param String $class
     * @return String Um link formatado
     */
    public static function createLink($url,$text,$class="") {
        return '<a class="'.$class.'" href="'.$url.'" >'.$text.'</a>';

    }
    /**
     * Retorna uma tag formatada de caixa de texto
     * @param String $id
     * @param String $name
     * @param int $maxlenght
     * @param int $size
     * @param String $default_value
     * @return String 
     */
    public static function createInputTextBox($id,$name,$maxlenght="35",$size="50",$default_value="") {
        return '<input type="text"
                    id="'.$id.
                '" name="'.$name.
                '" value="'.$default_value.
                '" size="'.$size.
                '" maxlenght="'.$maxlenght.'" />';
    }
    /**
     * Retorna uma formatação de TEXTAREA
     * @param String $id ID
     * @param String $name Nome
     * @param String $rows Número de linhas
     * @param String $cols Número de colunas
     * @param String $default_value Valor padrão
     * @return String
     */
    public static function createTextArea($id,$name,$rows="5",$cols="50",$default_value="") {
        return '<textarea name="'.$name.'" cols="'.$cols.'" rows="'.$rows.'">'.$default_value.'</textarea>';
    }
    /**
     * Retorna uma tag INPUT de seleção de arquivo
     * @param String $id
     * @param String $name
     * @return String
     */
    public static function createInputSelectFile($id,$name) {
        return '<input id="'.$id.'" type="file" name="'.$name.'">';
    }
    /**
     * Retorna uma tag INPUT de botão SUBMIT
     * @param String $name
     * @param String $value
     * @param Boolean $disabled
     * @param JavaScriptCommand $onclick
     * @return String
     */
    public static function createSubmitButton($name,$value="Enviar",$disabled=false,$onclick="") {
        if ($disabled == TRUE) $d = 'disabled="disabled"';
        return '<input id="'.$name.'" type="submit" name="'.$name.'" value="'.$value.'" '.$d.' onclick="'.$onclick.'" />';
    }
    /**
     * Retorna uma tag INPUT do tipo CHECKBOX
     * @param String $id
     * @param String $name
     * @param String $label
     * @param String $default_value
     * @return String
     */
    public static function createCheckBox($id, $name,$label,$default_value="1") {
        return '<input type="checkbox" id="'.$id.'" name="'.$name.'"><label for="'.$id.'">'.$label.'</label><br />';
    }
    /**
     * Retorna uma tag INPUT do tipo RADIO
     * @param String $id
     * @param String $name
     * @param String $nameGroup
     * @param String $value
     * @param String $checked
     * @return String
     */
    public static function createRadioOption($id,$name,$nameGroup,$value,$checked="") {
        if ($checked!="")$checked=' checked="checked" ';
        return '<input id="'.$id.'" name="'.$nameGroup.'" type="radio" value="'.$value.'" '.$checked. '/><label for="'.$id.'">'.$name.'</label><br />';
    }
    /**
     * Retorna uma tag INPUT do tipo oculta (HIDDEN)
     * @param String $name
     * @param String $value
     * @return String
     */
    public static function createHiddenInput($name,$value=""){
        return '<input type="hidden" name="'.$name.'" value="'.$value . '" />';
    }
    /**
     * Imprime caixa de seleção para escolha de uma data específica.
     * @param String $nameDay Nome da tag do dia
     * @param String $nameMonth Nome da tag do mês
     * @param String $nameYear Nome da tag do ano
     */
    public static function showInputCalendar($nameDay="dia",$nameMonth="mes", $nameYear="ano") {
        // <editor-fold defaultstate="collapsed" desc="Gerar um input com dia, mês e ano">

        ?>
                <script type="text/javascript">
                    function updateDaysInMonth() {
                        var daysInMonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                        var monthDropdown = document.getElementById('<?php echo $nameMonth; ?>');
                        var dayDropdown = document.getElementById('<?php echo $nameDay; ?>');
                        var dayIndex = dayDropdown.selectedIndex;
                        var month = monthDropdown.selectedIndex;
                        dayDropdown.length=0;
                        for (var i =1; i <= daysInMonth[month]; ++i) {
                            dayDropdown[i-1] = new Option (i,i,false,false);
                        }
                        if (dayIndex!=-1)
                            dayDropdown[dayIndex].selected=true;
                        else
                            dayDropdown[1].selected=true;
                    }
                </script>
                <select id="<?php echo $nameDay; ?>" name="<?php echo $nameDay?>">
                    <option value="1">1</option>
                </select> de
                <select id="<?php echo $nameMonth; ?>" name="<?php echo $nameMonth; ?>" onchange="updateDaysInMonth(); return false;">
                    <option value="1">janeiro</option>
                    <option value="2">fevereiro</option>
                    <option value="3">mar&ccedil;o</option>
                    <option value="4">abril</option>
                    <option value="5">maio</option>
                    <option value="6">junho</option>
                    <option value="7">julho</option>
                    <option value="8">agosto</option>
                    <option value="9">setembro</option>
                    <option value="10">outubro</option>
                    <option value="11">novembro</option>
                    <option value="12">dezembro</option>
                </select> de
                <select id="<?php echo $nameYear; ?>" name="<?php echo $nameYear; ?>" >
                    <?php
                        for ($i=date("Y")-1;$i>(date("Y")-110);$i--){
                            echo '<option value="'.$i.'">'.$i.'</option>'."\n";
                        }
                    ?>
                </select>
                <script type="text/javascript"> updateDaysInMonth(); </script>
                <?php
                // </editor-fold>
    }



}
?>
