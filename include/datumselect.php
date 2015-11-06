<?php
	function date_dropdown($tag, $selday, $selmonth, $selyear){
        $html_output = '    <div id="date_select">'."\n";

        /*days*/
        $html_output .= '           <select name="date_day_'.$tag.'" id="day_select">'."\n";
            for ($day = 1; $day <= 31; $day++) {
                $html_output .= '               <option value="'.$day.'"';
				if(isset($selday) && $day == $selday) $html_output .= ' selected';
				$html_output .= '>' . $day . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        /*months*/
        $html_output .= '           <select name="date_month_'.$tag.'" id="month_select" >'."\n";
        $months = array("", "januari", "februari", "maart", "april", "mei", "juni", "juli", "augustus", "september", "oktober", "november", "december");
            for ($month = 1; $month <= 12; $month++) {
                $html_output .= '               <option value="' . $month . '"';
				if(isset($selmonth) && $month == $selmonth) $html_output .= ' selected';
				$html_output .= '>' . $months[$month] . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        /*years*/
        $html_output .= '           <select name="date_year_'.$tag.'" id="year_select">'."\n";
            for ($year = 2015; $year <= (date("Y")+3); $year++) {
                $html_output .= '               <option value="'.$year.'"';
				if(isset($selyear) && $year == $selyear) $html_output .= ' selected';
				$html_output .= '>' . $year . '</option>'."\n";
            }
        $html_output .= '           </select>'."\n";

        $html_output .= '   </div>'."\n";
		return $html_output;
	}
?>