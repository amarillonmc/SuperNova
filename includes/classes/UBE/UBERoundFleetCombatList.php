<?php

/**
 * Class UBERoundFleetCombatList
 *
 * @method UBERoundFleetCombat offsetGet($offset)
 * @property UBERoundFleetCombat[] $_container
 */
class UBERoundFleetCombatList extends ArrayAccessV2 {

  /**
   * Какие стороны присутствуют. ТОЛЬКО ДЛЯ ИСПОЛЬЗОВАНИЯ в next_round_fleet_array()!!!!
   *
   * @var array
   */
  public $side_present_at_round_start = array();

  /**
   * @var UBEASA[]
   */
  public $UBE_TOTAL = array();

  public function __construct() {
    $this->UBE_TOTAL = array(
      UBE_PLAYER_IS_ATTACKER => new UBEASA(),
      UBE_PLAYER_IS_DEFENDER => new UBEASA(),
    );
  }

  public function __clone() {
    return parent::__clone(); // TODO: Change the autogenerated stub
  }

  /**
   * @param UBERoundFleetCombat $source
   */
  // OK3
  public function insert_from_UBERoundFleetCombat(UBERoundFleetCombat $source) {
    $destination = new UBERoundFleetCombat();
    $destination->init_from_UBERoundFleetCombat($source);
    $this[$destination->fleet_id] = $destination;

    $this->side_present_at_round_start[$destination->is_attacker] = 1;
  }



  /**
   * @param UBEFleet $source
   */
  // OK3
  public function insert_from_UBEFleet(UBEFleet $source) {
    $destination = new UBERoundFleetCombat();
    $destination->init_from_UBEFleet($source);
    $this[$destination->fleet_id] = $destination;

    $this->side_present_at_round_start[$destination->is_attacker] = 1;
  }

  /**
   * @param UBEFleetList $fleet_list
   */
  // OK4
  public function init_from_UBEFleetList(UBEFleetList $fleet_list) {
    foreach($fleet_list->_container as $fleet_id => $UBEFleet) {
      $this->insert_from_UBEFleet($UBEFleet);
    }
  }
  /**
   * @param UBEFleetList $fleet_info_list
   * @param bool         $is_simulator
   */
  // OK3
  public function sn_ube_combat_round_prepare($fleet_info_list, $is_simulator) {
    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      $UBERoundFleetCombat->load_unit_info_from_UBEFleet($fleet_info_list[$fleet_id], $is_simulator);
    }

    // Суммируем данные по атакующим и защитникам
    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      $this->UBE_TOTAL[$UBERoundFleetCombat->is_attacker]->add_unit_stats_array($UBERoundFleetCombat->total_stats);
    }

    // Высчитываем долю атаки, приходящейся на юнит равную отношению брони юнита к общей броне - крупные цели атакуют чаще
    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      $UBERoundFleetCombat->calculate_unit_partial_data($this->UBE_TOTAL[$UBERoundFleetCombat->is_attacker]);
    }
  }










  /**
   * @return int
   */
  // OK3
  public function calculate_attack_reapers() {
    $reapers = 0;
    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      if($UBERoundFleetCombat->is_attacker == UBE_PLAYER_IS_ATTACKER) {
        $reapers += $UBERoundFleetCombat->unit_list->get_reapers();
      }
    }

    return $reapers;
  }


  /**
   * Copies data to other UBERoundFleetCombatList object
   *
   * @param UBERoundFleetCombatList $destination
   */
  // OK3
  public function copy_active_data_to_other(UBERoundFleetCombatList $destination) {
    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      if($UBERoundFleetCombat->get_unit_count() <= 0) {
        continue;
      }

      $destination->insert_from_UBERoundFleetCombat($UBERoundFleetCombat);
    }
  }



  // REPORT ************************************************************************************************************
  //    REPORT SAVE ====================================================================================================
  /**
   * @param array $sql_perform_ube_report_unit
   * @param int   $ube_report_id
   * @param int   $round_number
   * @param int   $unit_sort_order
   */
  // OK6
  public function sql_generate_unit_array(array &$sql_perform_ube_report_unit, $ube_report_id, $round_number, &$unit_sort_order) {
    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      $UBERoundFleetCombat->sql_generate_unit_array($sql_perform_ube_report_unit, $ube_report_id, $round_number, $unit_sort_order);
    }
  }

  //    REPORT RENDER ==================================================================================================
  /**
   * @param UBE      $ube
   * @param UBERound $previousRound
   *
   * @return array
   */
  // OK3
  public function report_render_round_fleet_list(UBE $ube, UBERound $previousRound) {
    global $lang;

    $fleet_list_template = array(
      UBE_PLAYER_IS_ATTACKER => array(),
      UBE_PLAYER_IS_DEFENDER => array(),
    );

    foreach($this->_container as $fleet_id => $UBERoundFleetCombat) {
      $fleet_owner_id = $UBERoundFleetCombat->owner_id;
      $planet_ube_row = &$ube->fleet_list[$fleet_id]->UBE_PLANET;

      $template_fleet = array(
        'ID'          => $fleet_id,
        'IS_ATTACKER' => $UBERoundFleetCombat->is_attacker == UBE_PLAYER_IS_ATTACKER,
        'PLAYER_NAME' => $ube->players[$fleet_owner_id]->player_name_get(true),
      );

      if(is_array($planet_ube_row)) {
        $template_fleet += $planet_ube_row;
        $template_fleet[PLANET_NAME] = $template_fleet[PLANET_NAME] ? htmlentities($template_fleet[PLANET_NAME], ENT_COMPAT, 'UTF-8') : '';
        $template_fleet['PLANET_TYPE_TEXT'] = $lang['sys_planet_type_sh'][$template_fleet['PLANET_TYPE']];
      }

      $template_fleet['.']['ship'] = $UBERoundFleetCombat->report_render_ship_list(
        $previousRound->fleet_combat_data[$fleet_id]->unit_list
      );

      $fleet_list_template[$UBERoundFleetCombat->is_attacker][] = $template_fleet;
    }

    return array_merge($fleet_list_template[UBE_PLAYER_IS_ATTACKER], $fleet_list_template[UBE_PLAYER_IS_DEFENDER]);
  }

  //    REPORT LOAD ====================================================================================================
  /**
   * @param $report_unit_row
   * @param $player_side
   */
  // OK3
  public function load_fleet_from_report_unit_row($report_unit_row, $player_side) {
    $fleet_id = $report_unit_row['ube_report_unit_fleet_id'];
    if(!isset($this[$fleet_id])) {
      $this[$fleet_id] = new UBERoundFleetCombat();
      $this[$fleet_id]->init_fleet_from_report_unit_row($report_unit_row, $player_side);
    }

    $this[$fleet_id]->load_fleet_from_report_unit_row($report_unit_row);
  }



































  /**
   * Рассчитывает результат столкновения флотов ака раунд
   *
   * @param UBE $ube
   */
  // OK3
  public function calculate_attack_results(UBE $ube) {
    if(BE_DEBUG === true) {
      // sn_ube_combat_helper_round_header($round);
    }

    // Каждый флот атакует все
    foreach($this->_container as &$attack_fleet_data) {
      $attack_fleet_data->attack_fleets($this, $ube);
    }
    if(BE_DEBUG === true) {
      // sn_ube_combat_helper_round_footer();
    }
  }

}
