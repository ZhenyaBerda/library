<?php

namespace console\controllers;

use common\models\Publication;
use yii\console\Controller;
use common\models\Author;
use common\models\AuthorAlias;
use common\models\User;
use common\models\Journal;
use Exception;

class UtilController extends Controller
{

    public function actionTransferJournals()
    {

        $publications = Publication::find()->with('journal')->all();

        foreach ($publications as $publication) {
            if (!$publication->journal_id) {
                continue;
            }
            $journal = $publication->journal;

            if ($journal) {
                $publication->publisher_name = $journal->title;
                $publication->journal_id = null;
                $publication->save();
            }

            if (!Publication::find()->where(['journal_id' => $journal->id])->count()) {
                $journal->delete();
            }
        }
    }

    public function actionAddPublication()
    {
        $user = User::findOne(['username' => 'Admin']);

        foreach ($this->publicationsList as $year => $publicationsListYear) {
            foreach ($publicationsListYear as $publication) {
                $authorListId = $this->getAuthorListIdFromString($publication[0]);
                if (count($authorListId)) {
                    $model = new Publication();
                    $model->setAuthorListId($authorListId);
                    $model->journal_id = $this->findOrCreateJournalId($publication[2], $user->id);
                    $model->title = $publication[1];
                    $model->year = $year;
                    $model->rinch_id = strlen($publication[4]);
                    $model->wos_id = strlen($publication[5]);
                    $model->scopus_number = $publication[6];
                    $model->doi_number = $publication[7];
                    $model->user_id = $user->id;
                    $model->created_at = 1524899833;
                    $model->updated_at = 1524899833;
                    if ($this->isRussian($model->title)) {
                        $model->language_id = Publication::LANG_RU;
                    } else {
                        $model->language_id = Publication::LANG_EN;
                    }
                    $model->save();
                }
            }

        }
        return true;
    }

    /**
     * Найти либо создать издание/журнал
     * @param $title
     * @param $userId
     * @return int
     */
    public function findOrCreateJournalId($title, $userId)
    {
        $journal = Journal::find()->byTitle($title)->one();
        if (!$journal) {
            $journal = new Journal();
            $journal->title = $title;
            $journal->user_id = $userId;
            $journal->created_at = time();
            $journal->updated_at = time();
            $journal->save();
        }
        return $journal->id;
    }

    /**
     * Проверка на русские символы в тексте
     * @param $text
     * @return false|int
     */
    public function isRussian($text)
    {
        return preg_match('/[А-Яа-яЁё]/u', $text);
    }

    /**
     * Получить массив ID авторов, из строки
     * @param $authorListString
     * @return array
     * @throws Exception
     */
    public function getAuthorListIdFromString($authorListString)
    {
        $result = [];
        $authorList = explode(', ', $authorListString);
        foreach ($authorList as $fullname) {
            $authorId = $this->searchAuthorIdByLastName($fullname);
            if ($authorId) {
                $result[] = $authorId;
            }
        }
        return $result;
    }

    /**
     * Поиск имени из трех полей. Я методом подбора посчитал, что больше 4 символов в массиве - это фамилия
     * @param $fullName
     * @return mixed
     * @throws Exception
     */
    function getLastName($fullName)
    {
        $fullNameAsArray = explode(' ', $fullName);
        foreach ($fullNameAsArray as $item) {
            if (strlen($item) > 4) {
                return str_replace('.', '', $item);
            }
        }
        throw new Exception('Не нашли фамилию автора');
    }

    /**
     * Поиск id автора по его фамилии
     * @param $fullName
     * @return int|null
     * @throws Exception
     */
    function searchAuthorIdByLastName($fullName)
    {
        $lastName = $this->getLastName($fullName);
        $author = Author::find()->byLastName($lastName)->one();
        if (!$author) {
            $author = AuthorAlias::find()->byLastName($lastName)->one();
            return $author->author_id;
        }
        if (!$author) {
            return null;
        }
        return $author->id;
    }

    public $publicationsList = [
        '2016' => [
            ['Бутусов Д.Н., Каримов T.И., Тутуева А.В.', 'Аппаратно-ориентированные неявные численные методы решения дифференциальных уравнений', 'Фундаментальные исследования', '+', '+', '', '', '', ''],
            ['Каримов Т.И., Андреев В.С., Бутусов Д.Н.', 'Компьютерное моделирование цепей с электровакуумными приборами', 'Фундаментальные исследования', '+', '+', '', '', '', ''],
            ['Butusov D.N., Karimov T.I., Ostrovskii V.Y.', 'Semi-implicit ODE solver for matrix Riccati equation', '2016 IEEE NW Russia Young Researchers in Electrical and Electronic Engineering Conference (EIConRusNW)', '', '', '382668900043', '2-s2.0-84966551135', '10.1109/EIConRusNW.2016.7448146', ''],
            ['Butusov D.N., Karimov A.I., Tutueva A.V.', 'Symmetric extrapolation solvers for ordinary differential equations', '2016 IEEE NW Russia Young Researchers in Electrical and Electronic Engineering Conference (EIConRusNW)', '', '', '382668900042', '2-s2.0-84966659115', '10.1109/EIConRusNW.2016.7448145', ''],
            ['Karimov A.I., Karimov T.I., Butusov D.N.', 'Time-reversibility in chaotic problems numerical solution', '2016 IEEE NW Russia Young Researchers in Electrical and Electronic Engineering Conference (EIConRusNW)', '', '', '382668900057', '2-s2.0-84966565270', '10.1109/EIConRusNW.2016.7448160', ''],
            ['Andreev V.S., Goryainov S.V., Krasilnikov A.V.', 'Six-body problem solution using symplectic integrators', '2016 IEEE NW Russia Young Researchers in Electrical and Electronic Engineering Conference (EIConRusNW)', '', '', '382668900032', '2-s2.0-84966600784', '10.1109/EIConRusNW.2016.7448135', ''],
            ['Тутуева А.В., Красильников А.В., Горяинов С.В.', 'Экстраполяционный решатель нелинейных систем дифференциальных уравнений', '69-я Научно-техническая конференция профессорско-преподавательского состава университета: Сборник докладов студентов, аспирантов и молодых ученых', '', '', '', '', '', ''],
            ['Butusov D.N., Karimov A.I., Tutueva A.V.', 'Hardware-targeted Semi-implicit Extrapolation ODE Solvers', 'Proceedings of the 2016 International Siberian Conference on Control and Communications (SIBCON)', '', '', '383090900090', '2-s2.0-84978066740', '10.1109/SIBCON.2016.7491741', ''],
            ['Каримов Т.И., Бутусов Д.Н., Каримов А.И.', 'Компьютерное моделирование аудиосхем с вакуумными лампами', 'Сборник докладов XIX Международной конференции по мягким вычислениям и измерениям (SCM - 2016)', '', '+', '', '', '', ''],
            ['Бутусов Д.Н., Андреев В.С., Пестерев Д.О.', 'Композиционные полунеявные методы моделирования хаотических систем', 'Сборник докладов XIX Международной конференции по мягким вычислениям и измерениям (SCM - 2016)', '', '+', '', '', '', ''],
            ['Андреев В.С., Горяинов С.В. Красильников А.В.', 'Решение задачи N тел композиционными методами численного интегрирования', 'Сборник докладов XIX Международной конференции по мягким вычислениям и измерениям (SCM - 2016)', '', '+', '', '', '', ''],
            ['Коломойцев В.С., Красильников А.В., Бодров К.Ю.', 'Расчет вероятности обнаружения и устранения угроз безопасности информации в канале передачи данных', 'Сборник докладов XIX Международной конференции по мягким вычислениям и измерениям (SCM - 2016)', '', '+', '', '', '', ''],
            ['Butusov D.N., Tutueva A.V., Homitskaya E.S.', 'Extrapolation Semi-implicit ODE solvers with adaptive timestep', '2016 XIX IEEE International Conference on Soft Computing and Measurements (SCM)', '', '', '383221200042', '2-s2.0-84992052779', '10.1109/SCM.2016.7519708', ''],
            ['Karimov T.I., Butusov D.N., Karimov A.I.', 'Computer simulation of audio circuits with vacuum tubes', '2016 XIX IEEE International Conference on Soft Computing and Measurements (SCM)', '', '', '383221200034', '2-s2.0-84992053085', '10.1109/SCM.2016.7519700', ''],
            ['Butusov D.N., Andreev V.S., Pesterev D.O.', 'Composition semi-implicit methods for chaotic problems simulation', '2016 XIX IEEE International Conference on Soft Computing and Measurements (SCM)', '', '', '383221200032', '2-s2.0-84992154499', '10.1109/SCM.2016.7519698', ''],
            ['Andreev V.S., Goryainov S.V., Krasilnikov A.V.', 'N-body problem solution with composition numerical integration methods', '2016 XIX IEEE International Conference on Soft Computing and Measurements (SCM)', '', '', '383221200060', '2-s2.0-84992034554', '10.1109/SCM.2016.7519726', ''],
            ['Kolomoitcev V.S., Bodrov K.U., Krasilnikov A.V.', 'Calculating the probability of detection and removal of threats to information security in data channels', '2016 XIX IEEE International Conference on Soft Computing and Measurements (SCM)', '', '', '383221200007', '2-s2.0-84992109071', '10.1109/SCM.2016.7519672', ''],
            ['Ostrovskii V.Y., Butusov D.N., Toepfer H.', 'Application of the Semi-Implicit Numerical Integration Methods for the Simulation of Memristor-Based Circuits', 'Proceedings of the International Academic Forum AMO - SPITSE - NESEFF', '', '', '', '', '', ''],
            ['Каримов Т.И., Белкин Д.А., Топорская А.С., Севастьянова Т.С.', 'Система сбора биометрических данных пчелиного улья', 'Сборник трудов XV международной конференции NIDays 2016', '', '', '', '', '', ''],
            ['Пестерев Д.О., Бутусов Д.Н.', 'Моделирование и анализ хаотических нейронных сетей', 'Сборник трудов XV международной конференции NIDays 2016', '', '', '', '', '', ''],
            ['Каримов А.И., Лизунова И.А., Солдаткина А.А., Попова Е.Н., Бертыш В.А.', 'Система автоматизации исследования хаотических цепей', 'Сборник трудов XV международной конференции NIDays 2016', '', '', '', '', '', ''],
            ['Бутусов Д.Н., Андреев В.С., Каримов А.И.', 'Генераторы хаотических сигналов на основе полуявных алгоритмов численного интегрирования', 'Наука и образование: технология успеха: сб. докл. Международной научной конференции.', '', '', '', '', '', ''],
            ['Бутусов Д.Н., Каримов А.И., Каримов Т.И.', 'Аппаратно-ориентированные численные методы интегрирования.', 'Монография', '', '', '', '', '', ''],
            ['Каримов А.И., Островский В.Ю., Бутусов Д.Н.', 'Теоретические и практические аспекты машинной живописи', 'Программные системы и вычислительные методы', '+', '+', '', '', '10.7256/2305-6061.2016.4.21188', '']
        ],
        '2017' => [
            ['Andreev V.S., Goryainov S.V., Krasilnikov A.V., Sarma K.K.', 'Scaling Techniques for Fixed-Point Chaos Generators', 'Proceedings of the 2017 IEEE Russia Section Young Researchers in Electrical and Electronic Engineering Conference (2017 ElConRus)', '', '', '403395600065', '2-s2.0-85019430977', '10.1109/EIConRus.2017.7910542'],
            ['Butusov D.N., Karimov T.I., Lizunova I.A., Soldatkina A.A., Popova E.N.', 'Synchronization of Analog and Discrete Rössler Chaotic Systems', 'Proceedings of the 2017 IEEE Russia Section Young Researchers in Electrical and Electronic Engineering Conference (2017 ElConRus)', '', '', '403395600067', '2-s2.0-85019407601', '10.1109/EIConRus.2017.7910544'],
            ['Butusov D.N., Ostrovskii V.Y., Pesterev D.O.', 'Numerical Analysis of Memristor-Based Circuits with Semi-Implicit Methods', 'Proceedings of the 2017 IEEE Russia Section Young Researchers in Electrical and Electronic Engineering Conference (2017 ElConRus)', '', '', '403395600068', '2-s2.0-85019478128', '10.1109/EIConRus.2017.7910545'],
            ['Karimov A.I., Butusov D.N., Tutueva A.V.', 'Adaptive Explicit-Implicit Switching Solver for Stiff ODEs.', 'Proceedings of the 2017 IEEE Russia Section Young Researchers in Electrical and Electronic Engineering Conference (2017 ElConRus)', '', '', '403395600108', '2-s2.0-85019419292', '10.1109/EIConRus.2017.7910586'],
            ['Сольницев Р.И., Каримов А.И., Каримов Т.И.', 'Синтез цифровых регуляторов гироскопических командных приборов', 'Гироскопия и навигация', '', '', '', '', '10.17285/0869-7035.2017.25.1.108-118'],
            ['Butusov D.N., Karimov T.I., Kaplun D.I., Karimov A.I., Huang Y., Li Szu-Chuang', 'The Choice between Delta and Shift Operators for Low-Precision Data Representation', 'Proceeding of the 20th conference of FRUCT association', '', '', '', '2-s2.0-85037815420', '10.23919/FRUCT.2017.8071291'],
            ['Горяинов С.В., Белкин Д.А., Бутусов Д.Н., Рыбин В.Г., Савельев А.О.', 'Композиционные решатели обыкновенных дифференциальных уравнений в среде LABVIEW', 'Сборник трудов конференции NI Academic Days 2017', '', '', '', '', ''],
            ['Каримов А.И., Бутусов Д.Н., Белкин Д.А., Шаталов П.С., Солдаева А.А.', 'Адаптивный экстраполяционный решатель дифференциальных уравнений для среды LABVIEW', 'Сборник трудов конференции NI Academic Days 2017', '', '', '', '', ''],
            ['Филимонов О.А., Севастьянова Т.С., Топорская А.С., Белкин Д.А., Рыбин В.Г.', 'Система сбора данных о состоянии пчелиного улья', '70-я Научно-техническая конференция профессорско-преподавательского состава университета: Сборник докладов студентов, аспирантов и молодых ученых', '', '', '', '', ''],
            ['Бутусов Д.Н., Островский В.Ю., Тутуева А.В., Савельев А.О.', 'Сравнение алгоритмов мультипараметрического бифуркационного анализа', 'Сборник докладов XX Международной конференции по мягким вычислениям и измерениям (SCM - 2017)', '', '+', '', '', ''],
            ['Каримов А.И., Бутусов Д.Н., Рыбин В.Г., Каримов Т.И.', 'Исследование модифицированного отображения Чирикова', 'Сборник докладов XX Международной конференции по мягким вычислениям и измерениям (SCM - 2017)', '', '+', '', '', ''],
            ['Андреев В.С., Горяинов С.В., Островский В.Ю., Белкин Д.А.', 'Алгоритмы управления шагом интегрирования композиционных решателей ОДУ', 'Сборник докладов XX Международной конференции по мягким вычислениям и измерениям (SCM - 2017)', '', '+', '', '', ''],
            ['Белкин Д.А., Красильников А.В., Пестерев Д.О., Каримов Т.И.', 'Влияние возмущений в тракте передачи синхросигнала на погрешность синхронизации динамических систем', 'Сборник докладов XX Международной конференции по мягким вычислениям и измерениям (SCM - 2017)', '', '+', '', '', ''],
            ['Красильников А.В., Кузнецов А.Ю., Тушканов Е.В., Кузнецова О.В., Романова Е.Б.', 'Метод распознавания маскировочного покрытия на видеоспектральных снимках по критерию Неймана–Пирсона', 'Сборник докладов XX Международной конференции по мягким вычислениям и измерениям (SCM - 2017)', '', '+', '', '', ''],
            ['Горяинов С.В., Кузнецов А.Ю., Тушканов Е.В., Кузнецова О.В., Романова Е.Б.', 'Анализ байесовских математических систем распознавания образов для идентификации объектов на гиперспектральных снимках', 'Сборник докладов XX Международной конференции по мягким вычислениям и измерениям (SCM - 2017)', '', '+', '', '', ''],
            ['Huang Y., Li Szu-Chuang, Tai Bo-Chen, Chang Chieh-Ming, Kaplun D.I., Butusov D.N.', 'De-identification technique for iot wireless sensor network privacy protection', 'Jurnal Ilmu Komputer dan Informasi', '', '', '', '', 'http://dx.doi.org/10.21609/jiki.v10i1.440'],
            ['Butusov D.N., Karimov T.I., Kaplun D.I, Karimov A.I.', 'Delta Operator Filter Design for Hydroacoustic Tasks', 'Proceedings - Research Monograph of the 6th Mediterranean Conference on Embedded Computing (MECO) including 5th EUROMICRO/IEEE Workshop on Embedded and Cyber-Physical Systems (ECYPS’2017)', '', '', '', '2-s2.0-85027069612', '10.1109/MECO.2017.7977213'],
            ['Butusov D.N., Ostrovskii V.Y., Tutueva A.V., Savelev A.O.', 'Comparing the algorithms of multiparametric bifurcation analysis', 'XX IEEE International Conference on Soft Computing and Measurements (SCM - 2017)', '', '', '', '2-s2.0-85027185175', '10.1109/SCM.2017.7970536'],
            ['Karimov A.I., Butusov D.N., Rybin V.G., Karimov T.I.', 'The study of the modified Chirikov map', 'XX IEEE International Conference on Soft Computing and Measurements (SCM - 2017)', '', '', '', '2-s2.0-85027144734', '10.1109/SCM.2017.7970579'],
            ['Andreev V.S., Goryainov S.V., Ostrovskii V.Y., Belkin D.A.', 'Stepize control algorithms for composition ODE solvers', 'XX IEEE International Conference on Soft Computing and Measurements (SCM - 2017)', '', '', '', '2-s2.0-85027133326', '10.1109/SCM.2017.7970578'],
            ['Belkin D.A., Krasilnikov A.V., Pesterev D.O., Karimov T.I.', 'Influence of disturbances in sync signal path on dynamical systems synchronization', 'XX IEEE International Conference on Soft Computing and Measurements (SCM - 2017)', '', '', '', '2-s2.0-85027135340', '10.1109/SCM.2017.7970521'],
            ['Goryainov S.V., Kuznetsov A.Y., Tushkanov E.V., Kuznetsova O.V., Romanova E.B.', 'Analysis of Bayes mathematical systems of pattern recognition for identifying the objects on hyperspectral photographs', 'XX IEEE International Conference on Soft Computing and Measurements (SCM - 2017)', '', '', '', '2-s2.0-85027175222', '10.1109/SCM.2017.7970489'],
            ['Krasilnikov A.V., Kuznetsov A.Y., Tushkanov E.V., Kuznetsova O.V., Romanova E.B.', 'Method of detection the prevent coating on hyperspectral representation by Neumann-Pearson criterion', 'XX IEEE International Conference on Soft Computing and Measurements (SCM - 2017)', '', '', '', '2-s2.0-85027142170', '10.1109/SCM.2017.7970496'],
            ['Копец Е.Е., Рыбин В.Г.', 'Система сбора биометрических данных пчелиного улья', 'Наука настоящего и будущего', '', '', '', '', ''],
            ['Bagirova A. P., Notman O. V., Bagirov A. D., Goryainov S. V.', 'Subjective wellbeing of residents as an indicator of the social parthnership effectiveness in urban governance', '2017 International Conference «Quality Management, Transport and Information Security, Information Technologies» (IT&QM&IS)', '', '', '', '', '10.1109/ITMQIS.2017.8085747'],
            ['Tutueva A. V., Butusov D. N., Pesterev D. O., Belkin D. A., Ryzhov N. G.', 'Novel normalization technique for chaotic pseudo-random number generators based on semi-implicit ODE solvers', '2017 International Conference «Quality Management, Transport and Information Security, Information Technologies» (IT&QM&IS)', '', '', '', '2-s2.0-85040129353', '10.1109/ITMQIS.2017.8085814'],
            ['Karimov A. I., Pesterev D. O., Ostrovskii V. Y., Butusov D. N., Kopets E. E.', 'Brushstroke renedering algorithm for a painting robot', '2017 International Conference «Quality Management, Transport and Information Security, Information Technologies» (IT&QM&IS)', '', '', '', '2-s2.0-85040101645', '10.1109/ITMQIS.2017.8085826'],
            ['Н. П. Кобызев, А. Ю. Артамонов, А. И. Каримов, С. А. Голубев, С. В. Горяинов.', 'Встраиваемая система управления гусеничным роботом', 'II Международная научная конференция по проблемам управления в технических системах (CTS’2017)', '', '', '', '', ''],
            ['В. Г. Рыбин, Д. Н. Бутусов, Т. И. Каримов, Д. А. Белкин, М. Н. Козак.', 'Встраиваемая система сбора данных для мониторинга пчелиного улья', 'II Международная научная конференция по проблемам управления в технических системах (CTS’2017)', '', '', '', '', ''],
            ['V. G. Rybin, D. N. Butusov, T. I. Karimov, D. A. Belkin, M. N. Kozak.', 'Embedded data acquisition system for beehive monitoring', '2017 IEEE II International Conference on Control in Technical Systems (CTS)', '', '', '', '', '10.1109/CTSYS.2017.8109576'],
            ['N. P. Kobyzev, S. A. Golubev, Y. G. Artamonov, A. I. Karimov, S. V. Goryainov.', 'Embedded control system for tracked robot', '2017 IEEE II International Conference on Control in Technical Systems (CTS)', '', '', '', '', '10.1109/CTSYS.2017.8109519'],
            ['D. N. Butusov, V. Y. Ostrovskii, A. I. Karimov, D. A. Belkin.', 'Study of two-memcapacitor circuit model with semi-explicit ODE solver', 'Proceedings of the 21st conference of FRUCT Association', '', '', '', '', '10.23919/FRUCT.2017.8250166'],
            ['D. N. Butusov, V. Y. Ostrovskii, A. V. Zubarev.', 'Study of two-memristor circuit maodel with explicit composition method', 'Proceedings of 24th IEEE International Conference on Electronics, Circuits and Systems (ICECS)', '', '', '', '', ''],
            ['Д. Н. Бутусов, В. Ю. Островский, Т. И. Каримов, Д. И. Каплун.', 'Исследование хаотических широкополосных сигналов в контексте задач гидроакустики', 'Программные системы и вычислительные методы', '+', '+', '', '', '10.7256/2454-0714.2017.4.24786'],
            ['Д. Н. Бутусов, А. В. Тутуева, Д. О. Пестерев, В. Ю. Островский.', 'Исследование хаотических генераторов псевдослучайных последовательностей на основе решателей ОДУ', 'Программные системы и вычислительные методы', '+', '+', '', '', '10.7256/2454-0714.2017.4.24785'],
            ['Д. И. Каплун, В. В. Гульванский, И. И. Канатов, Д. М. Клионский, В. Ф. Лапицкий, В. И. Бобровский, А. Б. Хачатурян, Д. Н. Бутусов.', 'Разработка и исследование демодуляторов ППРЧ-сигналов', 'Известия вузов России. Радиоэлектроника.', '+', '+', '', '', ''],
            ['T. I. Karimov, D. N. Butusov, V. V. Gulvanskiy, D.V. Bogaevskiy.', 'Comparison of Chirp and Chaotic Wideband Signals for Hydroacoustics', 'Progress In Electromagnetics Research Symposium (PIERS – 2017)', '', '', '', '', ''],
            ['Синица А.М., Гульванский В.В., Каплун Д.И., Канатов И.И., Бутусов Д.Н.', 'Осциллограф RTB_2000', 'Электронные компоненты', '', '', '', '', ''],
            ['Рыбин В.Г., Бутусов Д.Н., Горяинов С.В., Кобызев Н.П.', 'Проектирование распределенных систем сбора биологических данных', 'Сборник научных трудов I Международной научно-практической конференции', '', '', '', '', ''],
            ['Горяинов С.В., Мартынов В.Ю., Бутусов Д.Н., Фахми Ш.С.', 'Подходы к оценке симметричности конечно-разностных моделей нелинейных динамических системы', 'Сборник научных трудов I Международной научно-практической конференции', '', '', '', '', ''],
            ['Okoli Gabriel C., Denis Butusov, Akanisi Michael U., Okwor Candidus O.', 'A review relevant processing techniques for handling array non-idealities', 'International digital organization for scientific research. IDOSR Journal of science and technology', '', '', '', '', ''],
            ['D.N. Butusov, A.I. Karimov, D.O. Pesterev, A.V. Tutueva, G. Okoli.', 'Bifurcation and recurrent analysis of memristive circuits', '2018 IEEE Conference of Russian Young Researches in Electrical and Electronic Engineering (ElConRus)', '', '', '', '', ''],
            ['S.V. Goryainov, V.S. Andreev, M.N. Kozak. R.A. Kozachek, V.G. Rybin.', 'Reversibility diagrams: a tool for finite-difference model study', '2018 IEEE Conference of Russian Young Researches in Electrical and Electronic Engineering (ElConRus)', '', '', '', '', ''],
            ['V.Y. Ostrovskii, D.N. Butusov, D.A. Belkin, G. Okoli', 'Studying the dynamics of memristive synapses in spiking neuromorphic systems', '2018 IEEE Conference of Russian Young Researches in Electrical and Electronic Engineering (ElConRus)', '', '', '', '', ''],
            ['T.I. Karimov, D.N. Butusov, D.O. Pesterev, D.V. Predtechenskii, R.S. Tedoradze', 'Quasi-chaotic mode detection and prevention in digital chaos generators', '2018 IEEE Conference of Russian Young Researches in Electrical and Electronic Engineering (ElConRus)', '', '', '', '', '', '']
        ]
    ];
}