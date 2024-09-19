<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TbBonusDia;
use App\Models\TbDeducaoDia;
use App\Models\tbMoedasUsuario;
use App\Models\TbImportacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;
use App\Models\vwEmpregadosModel;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PontosController extends Controller
{

    /**
     * Método responsável por retornar a view de login no sistema
     */
    public function login()
    {
        return view('login');
    }

    public function index()
    {

        $teste = DB::table('portal.materiais_fila')->select('nome')
            //->where('id_fila',$id_fila)
            ->get();

        $mat_cad = $_COOKIE['MATRICULA'];
        //$mat_cad = request()->cookie('MATRICULA');
        /*
        $matricula = $request->input('matUser');
      //  $matSuper = $request->input('supervisor');
        $data_abertura = date("Y-m-d H:i:s");

        $callModels = new genteCulturaGestaoMod();
        $callModels->agente_transf = strtoupper($matricula);
        $callModels->cad_por = $mat_cad;
        $callModels->dt_cadastro = $data_abertura;

        $callModels->save();
        */

        dd($mat_cad);
        return 'Pontos Controller!';
    }

    public function validarUsuario(Request $request)
    {

        $matricula = strtoupper($request->input("matricula"));
        $senha = $request->input("senha");

        $valida_usuario = Usuarios::select('mat_usuario', 'senha_usuario')->where("mat_usuario", $matricula)->first();

        /*
      if (typeof(Storage) !== "undefined") {
          localStorage.setItem('name', 'Treinaweb');
          sessionStorage.setItem('name', 'Treinaweb');
      }
*/
        $matPlansul = vwEmpregadosModel::select('login', 'login_dac')->where("login", $matricula)->first();
        //dd($matPlansul->login_dac);

        if (!is_null($valida_usuario)) {

            if (!is_null($valida_usuario->senha_usuario) && Hash::check($senha, $valida_usuario->senha_usuario)) {

                setcookie("MATRICULA", $matPlansul->login_dac, time() + (365 * 24 * 3600));
                return json_encode('validado');
            } else {
                return json_encode('nao_validado');
            }
        }
    }

    public function identificarAdm()
    {
        $mat = $_COOKIE['MATRICULA'];

        $funcao = vwEmpregadosModel::select('codfuncao')->where('logindac', $mat)->first(); //trocar para TbAdm (criar model)

        $op = $funcao->logindac == 1021 ? true : false;

        return $op;
    }

    public function consultarSaldo()
    {
        $mat = $_COOKIE['MATRICULA'];

        $nome = DB::table('portal.vw_empregados')->select('nome', 'codfuncao')->where('login_dac', $mat)->first();

        //dd($nome);

        $vw = DB::table('programa_pontos.vw_moedas_usuario as vw')
            ->select('vw.nivel_experiencia', 'vw.de_nivel_experiencia', 'vw.total_moedas', 'vw.qt_creditada as qt_moedas_anterior', 'xp1.id_nivel_experiencia', 'xp1.vr_minimo')
            ->join('programa_pontos.tb_pontuacao_nivel_experiencia as xp1', 'vw.de_nivel_experiencia', '=', 'xp1.de_nivel_experiencia')
            ->where('mat_usuario', $mat)
            ->first();

        // dd($vw);

        if ($vw->id_nivel_experiencia <= 4) {

            $xp2 = DB::table('programa_pontos.tb_pontuacao_nivel_experiencia as xp2')
                ->select('id_nivel_experiencia', 'de_nivel_experiencia', 'vr_minimo')
                ->where('id_nivel_experiencia', $vw->id_nivel_experiencia + 1)
                ->first();

            $info = [
                'nome' => $nome->nome,
                'nivel_atual' => $vw->de_nivel_experiencia,
                'nivel_seguinte' => $xp2->de_nivel_experiencia,
                'progresso_atual' => ($vw->nivel_experiencia - $vw->vr_minimo),
                'progresso_final' => ($xp2->vr_minimo - $vw->vr_minimo),
                'porcentagem' => 100 * ($vw->nivel_experiencia - $vw->vr_minimo) / ($xp2->vr_minimo - $vw->vr_minimo),
                'cresc' => ($vw->qt_moedas_anterior),
                /*'cresc' => ($vw->total_moedas - $vw->qt_moedas_anterior),*/
                'total_moedas' => $vw->total_moedas
            ];
        } else {

            $xp2 = DB::table('programa_pontos.tb_pontuacao_nivel_experiencia as xp2')
                ->select('id_nivel_experiencia', 'de_nivel_experiencia', 'vr_maximo')
                ->where('id_nivel_experiencia', $vw->id_nivel_experiencia)
                ->first();

            $info = [
                'nome' => $nome->nome,
                'nivel_atual' => $vw->de_nivel_experiencia,
                'nivel_seguinte' => '',
                'progresso_atual' => ($vw->nivel_experiencia - $vw->vr_minimo),
                'progresso_final' => 'Nível Máximo',
                'porcentagem' => 100 * ($vw->nivel_experiencia - $vw->vr_minimo) / ($xp2->vr_maximo - $vw->vr_minimo),
                'cresc' => ($vw->qt_moedas_anterior),
                /*'cresc' => ($vw->total_moedas - $vw->qt_moedas_anterior),*/
                'total_moedas' => $vw->total_moedas
            ];
        }

        return $info;
    }

    // VIEW INPUT DE PONTOS
    public function inputPontos()
    {

        return view('inputPontos');
    }

    public function buscarTiposBonusDeducao()
    {
        $tipoBonus = DB::table('programa_pontos.tb_tipo_bonificacao')
            ->select('id_tipo_bonificacao', 'de_tipo_bonificacao')
            // ->where('st_tipo_bonificacao', '=', 1)
            ->get()
            ->toArray();

        $tipoDeducao = DB::table('programa_pontos.tb_tipo_deducao')
            ->select('id_tipo_deducao', 'de_tipo_deducao')
            ->where('id_tipo_deducao', '=', 1)
            ->get()
            ->toArray();

        // dd($tipoDeducao);
        return compact(['tipoBonus', 'tipoDeducao']);
    }

    public function buscarColaboradores(Request $request)
    {
        $matriculas = $request->matricula;

        $operadores = DB::table('portal.vw_empregados')
            ->select('nome', 'login_dac as matricula')
            ->whereIn('login_dac', $matriculas)
            ->orderBy('nome')
            ->get()
            ->toArray();

        return $operadores;
    }

    public function salvarBonificacaoExtra(Request $request)
    {
        $mdlImportacao = new TbImportacao();

        $matriculas = $request->matricula;
        $descricao = $request->descricao;
        $tipo = $request->tipo;
        $data_bonus = $request->data;
        $mat_cadastro = $_COOKIE['MATRICULA'];
        $data_cadastro = date('Y-m-d H:i:s');
        $qtd_importado = count($matriculas);

        // SALVAR IMPORTAÇÃO
        $mdlImportacao->dh_importacao = $data_cadastro;
        $mdlImportacao->mat_importacao = $mat_cadastro;
        $mdlImportacao->qtd_importado = $qtd_importado;
        $mdlImportacao->ic_ativo = 1;

        $mdlImportacao->save();
        $co_importacao = $mdlImportacao->co_importacao;

        //SALVAR BONUS
        foreach ($matriculas as $matricula) {

            $mdlBonus = new TbBonusDia();

            $mdlBonus->dt_bonificada = $data_bonus;
            $mdlBonus->co_importacao = $co_importacao;
            $mdlBonus->mat_bonificada = $matricula;
            $mdlBonus->tp_bonificacao = $tipo;
            $mdlBonus->st_bonificacao = 1;
            $mdlBonus->dt_cadastro = $data_cadastro;
            $mdlBonus->mat_cadastro = $mat_cadastro;
            $mdlBonus->de_observacao = $descricao;

            $mdlBonus->save();
        }
    }

    public function salvarDeducaoExtra(Request $request)
    {
        $mdlImportacao = new TbImportacao();

        $matriculas = $request->matricula;
        $descricao = $request->descricao;
        $tipo = $request->tipo;
        $data_deducao = $request->data;
        $mat_cadastro = $_COOKIE['MATRICULA'];
        $data_cadastro = date('Y-m-d H:i:s');
        $qtd_importado = count($matriculas);

        // SALVAR IMPORTAÇÃO
        $mdlImportacao->dh_importacao = $data_cadastro;
        $mdlImportacao->mat_importacao = $mat_cadastro;
        $mdlImportacao->qtd_importado = $qtd_importado;
        $mdlImportacao->ic_ativo = 1;

        $mdlImportacao->save();
        $co_importacao = $mdlImportacao->co_importacao;

        //SALVAR DEDUÇÕES
        foreach ($matriculas as $matricula) {

            $mdlDeducao = new TbDeducaoDia();

            $mdlDeducao->dt_deducao = $data_deducao;
            $mdlDeducao->co_importacao = $co_importacao;
            $mdlDeducao->mat_deducao = $matricula;
            $mdlDeducao->tp_deducao = $tipo;
            $mdlDeducao->st_deducao = 1;
            $mdlDeducao->dt_cadastro = $data_cadastro;
            $mdlDeducao->mat_cadastro = $mat_cadastro;
            $mdlDeducao->de_observacao = $descricao;

            $mdlDeducao->save();
        }
    }

    // VIEW MEUS PONTOS
    // BUSCAR EXTRATO DE PONTOS DO OPERADOR
    public function buscarExtratoPontos()
    {
        $str_dt_inicio = strtotime('-30 days');
        // $str_dt_fim = strtotime('-1 day');

        $dt_inicio = date('Y-m-d', $str_dt_inicio);
        $dt_fim = date('Y-m-d');

        $mat = $_COOKIE['MATRICULA'];

        $extrato = DB::select('SELECT * FROM programa_pontos.fn_extrato_moedas(:dt_inicio, :dt_fim, :mat) ORDER BY data DESC', [
            'dt_inicio' => $dt_inicio,
            'dt_fim' => $dt_fim,
            'mat' => $mat
        ]);

        foreach ($extrato as $dia) {
            $dia->moedas_nivel = intval($dia->moedas_nivel);
            $dia->hora_extra = intval($dia->hora_extra);
            $dia->tma = intval($dia->tma);
            $dia->elogios = intval($dia->elogios);
            $dia->falta_justificada = intval($dia->falta_justificada);
            $dia->falta_injustificada = intval($dia->falta_injustificada);
            $dia->falta_postural = intval($dia->falta_postural);
            $dia->glosa_de_qualidade = intval($dia->glosa_de_qualidade);
            $dia->compras_dia = intval($dia->compras_dia);
        }

        return $extrato;
    }

    public function filtrarExtratoPontos(Request $request)
    {
        $dt_inicio = $request->dt_inicio;
        $dt_fim = $request->dt_fim;

        $mat = $_COOKIE['MATRICULA'];

        $extrato = DB::select('SELECT * FROM programa_pontos.fn_extrato_moedas(:dt_inicio, :dt_fim, :mat) ORDER BY data DESC', [
            'dt_inicio' => $dt_inicio,
            'dt_fim' => $dt_fim,
            'mat' => $mat
        ]);

        foreach ($extrato as $dia) {
            $dia->moedas_nivel = intval($dia->moedas_nivel);
            $dia->hora_extra = intval($dia->hora_extra);
            $dia->tma = intval($dia->tma);
            $dia->elogios = intval($dia->elogios);
            $dia->falta_justificada = intval($dia->falta_justificada);
            $dia->falta_injustificada = intval($dia->falta_injustificada);
            $dia->falta_postural = intval($dia->falta_postural);
            $dia->glosa_de_qualidade = intval($dia->glosa_de_qualidade);
            $dia->compras_dia = intval($dia->compras_dia);
        }

        return $extrato;
    }
}
