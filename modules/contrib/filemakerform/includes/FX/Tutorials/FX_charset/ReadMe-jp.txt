About FX_charset / This file is encoded by Shift-JIS code.
---------

FX_charaset�ɂ���

2005/1/28
�V����s�imsyk@msyk.net�j

PHP��FileMaker�̃f�[�^�x�[�X�A�N�Z�X���\�ȃN���X�uFX.php�v�iChris Hansen��j���L���g���Ă��܂��B��FX.php�̃��b�p�[�N���X��FX_charset�ł��B
http://www.iviking.org/FX.php/

FX.php��Ver.3.0�ȍ~��FileMaker Server 7 Advanced�Ǝg���ꍇ�ɂ́A�y�[�W�̕����R�[�h��UTF-8�ƂȂ�悤�Ƀw�b�_�w�肷�邱�ƂŁA���{������̂܂܎g���܂��B�������Ȃ���AASCII�R�[�h���͂��ꂽ�͈͂̕�����́A&#12345;�̂悤�ȃR�[�h�\�L�ɂȂ�A�\�[�X�����ē��e�̔��ʂ��ł��Ȃ��ł����A���O���쐬�����葼�̃f�[�^�x�[�X���邢�̓T�[�o�ɐڑ�����悤�ȏꍇ�Ɏx�Ⴊ�ł܂��B

FX_charset�N���X���g�����Ƃł��̖��͉�������܂��B�����Z�b�g���w�肷�邱�ƂŁA�����͕����Ƃ��Ă�����ƌ����܂��B

���f���̗��p���@��
FX_charaset�t�H���_�ɂ���Book_List.fp7���AFileMaker Server 7 Advanced�Ō��J���܂��B���̃f�[�^�x�[�X�́Aadmin�ƃQ�X�g��[���S�A�N�Z�X]��^���Ă���̂Œ��ӂ����Ă��������B
FX_charaset�t�H���_��Web���J�\�ȂƂ���ɃR�s�[���܂��B�����āAFX_charaset�t�H���_�ɂ���index-utf8.php�A�Ȃ�����index-euc-jp.php�̃t�@�C���ɃA�N�Z�X���Ă��������B���ꂼ��A�y�[�W�Ɏg�������Z�b�g�̈Ⴂ�����邾���ł��B
index-fx.php�́AFX.php�ɂ���FX�N���X�����̂܂܎g�����ꍇ�̃f���ł��B���Ђ̏ڍ׃y�[�W�ŁATitle�t�B�[���h�̕������1�������������Ă��܂����AFX.php���ƕ����񂪕�����Q�ƌ`���i&#nnnnn�̂悤�Ȃ��́j�œ�����̂ŁAHTML�\�������ł͖��͏o�܂��񂪁APHP�ŕ����񏈗�������ƂȂ�Ɩ��ɂȂ�܂��B���Ђ̏ڍ׃y�[�W�ł̖����̕\���ɒ��ڂ��Ă��������B

��FX_charaset�̗��p���@��
FX.php�̃��b�p�[�N���X�Ȃ̂ŁA��{�I�ɂ�FX.php�Ɠ��l�ł��B�قȂ�͈̂ȉ��̓_�ł��B

�E�N���X�����́A�������Anew FX(...)�̑����new FX_charset(...)�ɂ��܂��B

�E�R���X�g���N�^�̖߂�l��$fx�Ƃ����ꍇ�A�ȉ��̃��\�b�h���Ăяo���܂��B

FileMaker Server 7 Advanced�^�y�[�W�̕����Z�b�g��UTF-8
$fx = new FX_charset( ... );
// ���ɂǂ̃��\�b�h���Ă΂Ȃ��Ă��A�����R�[�h��UTF-8�ŏ������܂��B

FileMaker Server 7 Advanced�^�y�[�W�̕����Z�b�g��EUC-JP
$fx = new FX_charset( ... );
$fx->SetCharacterEncoding('EUC-JP');
$fx->SetDataParamsEncoding('utf8');

�t�@�C�����[�J�[Pro 6/Unlimited�^�y�[�W�̕����Z�b�g��UTF-8
$fx = new FX_charset( ... );
$fx->SetCharacterEncoding('utf8');
$fx->SetDataParamsEncoding('SJIS');

�t�@�C�����[�J�[Pro 6/Unlimited�^�y�[�W�̕����Z�b�g��EUC-JP
$fx = new FX_charset( ... );
$fx->SetCharacterEncoding('EUC-JP');
$fx->SetDataParamsEncoding('SJIS');

�����̑���
FX_charset.php����AFX.php���C���N���[�h���Ă��܂��B���̂Ƃ��AFX.php�́AFX._charset.php�Ɠ����t�H���_�ɂ���FX�t�H���_�̒��ɂ���Ɖ��肵�Ă��܂��B�܂�A'FX/FX.php'�Ƃ������΃p�X�ŎQ�Ƃ����Ă��܂��B

FX�t�H���_�̓��e�́A�I���W�i����FX.php Ver.3.1(2004/12/28���J)�Ɠ���ł��B

FX_charset�̃��C�Z���X�́AFX.php�Ɠ���Ƃ��܂��B

