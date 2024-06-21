// coverage:ignore-file
// GENERATED CODE - DO NOT MODIFY BY HAND
// ignore_for_file: type=lint
// ignore_for_file: unused_element, deprecated_member_use, deprecated_member_use_from_same_package, use_function_type_syntax_for_parameters, unnecessary_const, avoid_init_to_null, invalid_override_different_default_values_named, prefer_expression_function_bodies, annotate_overrides, invalid_annotation_target, unnecessary_question_mark

part of 'gallery_model.dart';

// **************************************************************************
// FreezedGenerator
// **************************************************************************

T _$identity<T>(T value) => value;

final _privateConstructorUsedError = UnsupportedError(
    'It seems like you constructed your class using `MyClass._()`. This constructor is only meant to be used by freezed and you are not supposed to need it nor use it.\nPlease check the documentation here for more information: https://github.com/rrousselGit/freezed#custom-getters-and-methods');

GalleryModel _$GalleryModelFromJson(Map<String, dynamic> json) {
  return _GalleryModel.fromJson(json);
}

/// @nodoc
mixin _$GalleryModel {
  @HiveField(0)
  GalleryType? get galleryType => throw _privateConstructorUsedError;
  @HiveField(0)
  set galleryType(GalleryType? value) => throw _privateConstructorUsedError;
  @HiveField(1)
  String? get filePath => throw _privateConstructorUsedError;
  @HiveField(1)
  set filePath(String? value) => throw _privateConstructorUsedError;
  @HiveField(2)
  String? get thumbnailPath => throw _privateConstructorUsedError;
  @HiveField(2)
  set thumbnailPath(String? value) => throw _privateConstructorUsedError;
  @HiveField(3)
  String? get description => throw _privateConstructorUsedError;
  @HiveField(3)
  set description(String? value) => throw _privateConstructorUsedError;
  @HiveField(4)
  int? get siteId => throw _privateConstructorUsedError;
  @HiveField(4)
  set siteId(int? value) => throw _privateConstructorUsedError;
  @HiveField(5)
  int? get superId => throw _privateConstructorUsedError;
  @HiveField(5)
  set superId(int? value) => throw _privateConstructorUsedError;

  Map<String, dynamic> toJson() => throw _privateConstructorUsedError;
  @JsonKey(ignore: true)
  $GalleryModelCopyWith<GalleryModel> get copyWith =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $GalleryModelCopyWith<$Res> {
  factory $GalleryModelCopyWith(
          GalleryModel value, $Res Function(GalleryModel) then) =
      _$GalleryModelCopyWithImpl<$Res, GalleryModel>;
  @useResult
  $Res call(
      {@HiveField(0) GalleryType? galleryType,
      @HiveField(1) String? filePath,
      @HiveField(2) String? thumbnailPath,
      @HiveField(3) String? description,
      @HiveField(4) int? siteId,
      @HiveField(5) int? superId});
}

/// @nodoc
class _$GalleryModelCopyWithImpl<$Res, $Val extends GalleryModel>
    implements $GalleryModelCopyWith<$Res> {
  _$GalleryModelCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? galleryType = freezed,
    Object? filePath = freezed,
    Object? thumbnailPath = freezed,
    Object? description = freezed,
    Object? siteId = freezed,
    Object? superId = freezed,
  }) {
    return _then(_value.copyWith(
      galleryType: freezed == galleryType
          ? _value.galleryType
          : galleryType // ignore: cast_nullable_to_non_nullable
              as GalleryType?,
      filePath: freezed == filePath
          ? _value.filePath
          : filePath // ignore: cast_nullable_to_non_nullable
              as String?,
      thumbnailPath: freezed == thumbnailPath
          ? _value.thumbnailPath
          : thumbnailPath // ignore: cast_nullable_to_non_nullable
              as String?,
      description: freezed == description
          ? _value.description
          : description // ignore: cast_nullable_to_non_nullable
              as String?,
      siteId: freezed == siteId
          ? _value.siteId
          : siteId // ignore: cast_nullable_to_non_nullable
              as int?,
      superId: freezed == superId
          ? _value.superId
          : superId // ignore: cast_nullable_to_non_nullable
              as int?,
    ) as $Val);
  }
}

/// @nodoc
abstract class _$$GalleryModelImplCopyWith<$Res>
    implements $GalleryModelCopyWith<$Res> {
  factory _$$GalleryModelImplCopyWith(
          _$GalleryModelImpl value, $Res Function(_$GalleryModelImpl) then) =
      __$$GalleryModelImplCopyWithImpl<$Res>;
  @override
  @useResult
  $Res call(
      {@HiveField(0) GalleryType? galleryType,
      @HiveField(1) String? filePath,
      @HiveField(2) String? thumbnailPath,
      @HiveField(3) String? description,
      @HiveField(4) int? siteId,
      @HiveField(5) int? superId});
}

/// @nodoc
class __$$GalleryModelImplCopyWithImpl<$Res>
    extends _$GalleryModelCopyWithImpl<$Res, _$GalleryModelImpl>
    implements _$$GalleryModelImplCopyWith<$Res> {
  __$$GalleryModelImplCopyWithImpl(
      _$GalleryModelImpl _value, $Res Function(_$GalleryModelImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? galleryType = freezed,
    Object? filePath = freezed,
    Object? thumbnailPath = freezed,
    Object? description = freezed,
    Object? siteId = freezed,
    Object? superId = freezed,
  }) {
    return _then(_$GalleryModelImpl(
      galleryType: freezed == galleryType
          ? _value.galleryType
          : galleryType // ignore: cast_nullable_to_non_nullable
              as GalleryType?,
      filePath: freezed == filePath
          ? _value.filePath
          : filePath // ignore: cast_nullable_to_non_nullable
              as String?,
      thumbnailPath: freezed == thumbnailPath
          ? _value.thumbnailPath
          : thumbnailPath // ignore: cast_nullable_to_non_nullable
              as String?,
      description: freezed == description
          ? _value.description
          : description // ignore: cast_nullable_to_non_nullable
              as String?,
      siteId: freezed == siteId
          ? _value.siteId
          : siteId // ignore: cast_nullable_to_non_nullable
              as int?,
      superId: freezed == superId
          ? _value.superId
          : superId // ignore: cast_nullable_to_non_nullable
              as int?,
    ));
  }
}

/// @nodoc
@JsonSerializable()
@HiveType(typeId: 0, adapterName: 'GalleryModelAdapter')
class _$GalleryModelImpl extends _GalleryModel {
  _$GalleryModelImpl(
      {@HiveField(0) this.galleryType,
      @HiveField(1) this.filePath,
      @HiveField(2) this.thumbnailPath,
      @HiveField(3) this.description,
      @HiveField(4) this.siteId,
      @HiveField(5) this.superId})
      : super._();

  factory _$GalleryModelImpl.fromJson(Map<String, dynamic> json) =>
      _$$GalleryModelImplFromJson(json);

  @override
  @HiveField(0)
  GalleryType? galleryType;
  @override
  @HiveField(1)
  String? filePath;
  @override
  @HiveField(2)
  String? thumbnailPath;
  @override
  @HiveField(3)
  String? description;
  @override
  @HiveField(4)
  int? siteId;
  @override
  @HiveField(5)
  int? superId;

  @override
  String toString() {
    return 'GalleryModel(galleryType: $galleryType, filePath: $filePath, thumbnailPath: $thumbnailPath, description: $description, siteId: $siteId, superId: $superId)';
  }

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$GalleryModelImplCopyWith<_$GalleryModelImpl> get copyWith =>
      __$$GalleryModelImplCopyWithImpl<_$GalleryModelImpl>(this, _$identity);

  @override
  Map<String, dynamic> toJson() {
    return _$$GalleryModelImplToJson(
      this,
    );
  }
}

abstract class _GalleryModel extends GalleryModel {
  factory _GalleryModel(
      {@HiveField(0) GalleryType? galleryType,
      @HiveField(1) String? filePath,
      @HiveField(2) String? thumbnailPath,
      @HiveField(3) String? description,
      @HiveField(4) int? siteId,
      @HiveField(5) int? superId}) = _$GalleryModelImpl;
  _GalleryModel._() : super._();

  factory _GalleryModel.fromJson(Map<String, dynamic> json) =
      _$GalleryModelImpl.fromJson;

  @override
  @HiveField(0)
  GalleryType? get galleryType;
  @HiveField(0)
  set galleryType(GalleryType? value);
  @override
  @HiveField(1)
  String? get filePath;
  @HiveField(1)
  set filePath(String? value);
  @override
  @HiveField(2)
  String? get thumbnailPath;
  @HiveField(2)
  set thumbnailPath(String? value);
  @override
  @HiveField(3)
  String? get description;
  @HiveField(3)
  set description(String? value);
  @override
  @HiveField(4)
  int? get siteId;
  @HiveField(4)
  set siteId(int? value);
  @override
  @HiveField(5)
  int? get superId;
  @HiveField(5)
  set superId(int? value);
  @override
  @JsonKey(ignore: true)
  _$$GalleryModelImplCopyWith<_$GalleryModelImpl> get copyWith =>
      throw _privateConstructorUsedError;
}
