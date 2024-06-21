// coverage:ignore-file
// GENERATED CODE - DO NOT MODIFY BY HAND
// ignore_for_file: type=lint
// ignore_for_file: unused_element, deprecated_member_use, deprecated_member_use_from_same_package, use_function_type_syntax_for_parameters, unnecessary_const, avoid_init_to_null, invalid_override_different_default_values_named, prefer_expression_function_bodies, annotate_overrides, invalid_annotation_target, unnecessary_question_mark

part of 'auth_event.dart';

// **************************************************************************
// FreezedGenerator
// **************************************************************************

T _$identity<T>(T value) => value;

final _privateConstructorUsedError = UnsupportedError(
    'It seems like you constructed your class using `MyClass._()`. This constructor is only meant to be used by freezed and you are not supposed to need it nor use it.\nPlease check the documentation here for more information: https://github.com/rrousselGit/freezed#custom-getters-and-methods');

/// @nodoc
mixin _$AuthEvent {
  Object get data => throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(GetOtpRequestModel data) getOtp,
    required TResult Function(ValidateOtpRequestModel data) validateOtp,
    required TResult Function(UpdatePasswordRequestModel data) updatePassword,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(GetOtpRequestModel data)? getOtp,
    TResult? Function(ValidateOtpRequestModel data)? validateOtp,
    TResult? Function(UpdatePasswordRequestModel data)? updatePassword,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(GetOtpRequestModel data)? getOtp,
    TResult Function(ValidateOtpRequestModel data)? validateOtp,
    TResult Function(UpdatePasswordRequestModel data)? updatePassword,
    required TResult orElse(),
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(GetOtp value) getOtp,
    required TResult Function(ValidateOtp value) validateOtp,
    required TResult Function(UpdatePassword value) updatePassword,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(GetOtp value)? getOtp,
    TResult? Function(ValidateOtp value)? validateOtp,
    TResult? Function(UpdatePassword value)? updatePassword,
  }) =>
      throw _privateConstructorUsedError;
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(GetOtp value)? getOtp,
    TResult Function(ValidateOtp value)? validateOtp,
    TResult Function(UpdatePassword value)? updatePassword,
    required TResult orElse(),
  }) =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class $AuthEventCopyWith<$Res> {
  factory $AuthEventCopyWith(AuthEvent value, $Res Function(AuthEvent) then) =
      _$AuthEventCopyWithImpl<$Res, AuthEvent>;
}

/// @nodoc
class _$AuthEventCopyWithImpl<$Res, $Val extends AuthEvent>
    implements $AuthEventCopyWith<$Res> {
  _$AuthEventCopyWithImpl(this._value, this._then);

  // ignore: unused_field
  final $Val _value;
  // ignore: unused_field
  final $Res Function($Val) _then;
}

/// @nodoc
abstract class _$$GetOtpImplCopyWith<$Res> {
  factory _$$GetOtpImplCopyWith(
          _$GetOtpImpl value, $Res Function(_$GetOtpImpl) then) =
      __$$GetOtpImplCopyWithImpl<$Res>;
  @useResult
  $Res call({GetOtpRequestModel data});
}

/// @nodoc
class __$$GetOtpImplCopyWithImpl<$Res>
    extends _$AuthEventCopyWithImpl<$Res, _$GetOtpImpl>
    implements _$$GetOtpImplCopyWith<$Res> {
  __$$GetOtpImplCopyWithImpl(
      _$GetOtpImpl _value, $Res Function(_$GetOtpImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = null,
  }) {
    return _then(_$GetOtpImpl(
      null == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as GetOtpRequestModel,
    ));
  }
}

/// @nodoc

class _$GetOtpImpl implements GetOtp {
  _$GetOtpImpl(this.data);

  @override
  final GetOtpRequestModel data;

  @override
  String toString() {
    return 'AuthEvent.getOtp(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$GetOtpImpl &&
            (identical(other.data, data) || other.data == data));
  }

  @override
  int get hashCode => Object.hash(runtimeType, data);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$GetOtpImplCopyWith<_$GetOtpImpl> get copyWith =>
      __$$GetOtpImplCopyWithImpl<_$GetOtpImpl>(this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(GetOtpRequestModel data) getOtp,
    required TResult Function(ValidateOtpRequestModel data) validateOtp,
    required TResult Function(UpdatePasswordRequestModel data) updatePassword,
  }) {
    return getOtp(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(GetOtpRequestModel data)? getOtp,
    TResult? Function(ValidateOtpRequestModel data)? validateOtp,
    TResult? Function(UpdatePasswordRequestModel data)? updatePassword,
  }) {
    return getOtp?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(GetOtpRequestModel data)? getOtp,
    TResult Function(ValidateOtpRequestModel data)? validateOtp,
    TResult Function(UpdatePasswordRequestModel data)? updatePassword,
    required TResult orElse(),
  }) {
    if (getOtp != null) {
      return getOtp(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(GetOtp value) getOtp,
    required TResult Function(ValidateOtp value) validateOtp,
    required TResult Function(UpdatePassword value) updatePassword,
  }) {
    return getOtp(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(GetOtp value)? getOtp,
    TResult? Function(ValidateOtp value)? validateOtp,
    TResult? Function(UpdatePassword value)? updatePassword,
  }) {
    return getOtp?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(GetOtp value)? getOtp,
    TResult Function(ValidateOtp value)? validateOtp,
    TResult Function(UpdatePassword value)? updatePassword,
    required TResult orElse(),
  }) {
    if (getOtp != null) {
      return getOtp(this);
    }
    return orElse();
  }
}

abstract class GetOtp implements AuthEvent {
  factory GetOtp(final GetOtpRequestModel data) = _$GetOtpImpl;

  @override
  GetOtpRequestModel get data;
  @JsonKey(ignore: true)
  _$$GetOtpImplCopyWith<_$GetOtpImpl> get copyWith =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class _$$ValidateOtpImplCopyWith<$Res> {
  factory _$$ValidateOtpImplCopyWith(
          _$ValidateOtpImpl value, $Res Function(_$ValidateOtpImpl) then) =
      __$$ValidateOtpImplCopyWithImpl<$Res>;
  @useResult
  $Res call({ValidateOtpRequestModel data});
}

/// @nodoc
class __$$ValidateOtpImplCopyWithImpl<$Res>
    extends _$AuthEventCopyWithImpl<$Res, _$ValidateOtpImpl>
    implements _$$ValidateOtpImplCopyWith<$Res> {
  __$$ValidateOtpImplCopyWithImpl(
      _$ValidateOtpImpl _value, $Res Function(_$ValidateOtpImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = null,
  }) {
    return _then(_$ValidateOtpImpl(
      null == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as ValidateOtpRequestModel,
    ));
  }
}

/// @nodoc

class _$ValidateOtpImpl implements ValidateOtp {
  _$ValidateOtpImpl(this.data);

  @override
  final ValidateOtpRequestModel data;

  @override
  String toString() {
    return 'AuthEvent.validateOtp(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$ValidateOtpImpl &&
            (identical(other.data, data) || other.data == data));
  }

  @override
  int get hashCode => Object.hash(runtimeType, data);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$ValidateOtpImplCopyWith<_$ValidateOtpImpl> get copyWith =>
      __$$ValidateOtpImplCopyWithImpl<_$ValidateOtpImpl>(this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(GetOtpRequestModel data) getOtp,
    required TResult Function(ValidateOtpRequestModel data) validateOtp,
    required TResult Function(UpdatePasswordRequestModel data) updatePassword,
  }) {
    return validateOtp(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(GetOtpRequestModel data)? getOtp,
    TResult? Function(ValidateOtpRequestModel data)? validateOtp,
    TResult? Function(UpdatePasswordRequestModel data)? updatePassword,
  }) {
    return validateOtp?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(GetOtpRequestModel data)? getOtp,
    TResult Function(ValidateOtpRequestModel data)? validateOtp,
    TResult Function(UpdatePasswordRequestModel data)? updatePassword,
    required TResult orElse(),
  }) {
    if (validateOtp != null) {
      return validateOtp(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(GetOtp value) getOtp,
    required TResult Function(ValidateOtp value) validateOtp,
    required TResult Function(UpdatePassword value) updatePassword,
  }) {
    return validateOtp(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(GetOtp value)? getOtp,
    TResult? Function(ValidateOtp value)? validateOtp,
    TResult? Function(UpdatePassword value)? updatePassword,
  }) {
    return validateOtp?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(GetOtp value)? getOtp,
    TResult Function(ValidateOtp value)? validateOtp,
    TResult Function(UpdatePassword value)? updatePassword,
    required TResult orElse(),
  }) {
    if (validateOtp != null) {
      return validateOtp(this);
    }
    return orElse();
  }
}

abstract class ValidateOtp implements AuthEvent {
  factory ValidateOtp(final ValidateOtpRequestModel data) = _$ValidateOtpImpl;

  @override
  ValidateOtpRequestModel get data;
  @JsonKey(ignore: true)
  _$$ValidateOtpImplCopyWith<_$ValidateOtpImpl> get copyWith =>
      throw _privateConstructorUsedError;
}

/// @nodoc
abstract class _$$UpdatePasswordImplCopyWith<$Res> {
  factory _$$UpdatePasswordImplCopyWith(_$UpdatePasswordImpl value,
          $Res Function(_$UpdatePasswordImpl) then) =
      __$$UpdatePasswordImplCopyWithImpl<$Res>;
  @useResult
  $Res call({UpdatePasswordRequestModel data});
}

/// @nodoc
class __$$UpdatePasswordImplCopyWithImpl<$Res>
    extends _$AuthEventCopyWithImpl<$Res, _$UpdatePasswordImpl>
    implements _$$UpdatePasswordImplCopyWith<$Res> {
  __$$UpdatePasswordImplCopyWithImpl(
      _$UpdatePasswordImpl _value, $Res Function(_$UpdatePasswordImpl) _then)
      : super(_value, _then);

  @pragma('vm:prefer-inline')
  @override
  $Res call({
    Object? data = null,
  }) {
    return _then(_$UpdatePasswordImpl(
      null == data
          ? _value.data
          : data // ignore: cast_nullable_to_non_nullable
              as UpdatePasswordRequestModel,
    ));
  }
}

/// @nodoc

class _$UpdatePasswordImpl implements UpdatePassword {
  _$UpdatePasswordImpl(this.data);

  @override
  final UpdatePasswordRequestModel data;

  @override
  String toString() {
    return 'AuthEvent.updatePassword(data: $data)';
  }

  @override
  bool operator ==(Object other) {
    return identical(this, other) ||
        (other.runtimeType == runtimeType &&
            other is _$UpdatePasswordImpl &&
            (identical(other.data, data) || other.data == data));
  }

  @override
  int get hashCode => Object.hash(runtimeType, data);

  @JsonKey(ignore: true)
  @override
  @pragma('vm:prefer-inline')
  _$$UpdatePasswordImplCopyWith<_$UpdatePasswordImpl> get copyWith =>
      __$$UpdatePasswordImplCopyWithImpl<_$UpdatePasswordImpl>(
          this, _$identity);

  @override
  @optionalTypeArgs
  TResult when<TResult extends Object?>({
    required TResult Function(GetOtpRequestModel data) getOtp,
    required TResult Function(ValidateOtpRequestModel data) validateOtp,
    required TResult Function(UpdatePasswordRequestModel data) updatePassword,
  }) {
    return updatePassword(data);
  }

  @override
  @optionalTypeArgs
  TResult? whenOrNull<TResult extends Object?>({
    TResult? Function(GetOtpRequestModel data)? getOtp,
    TResult? Function(ValidateOtpRequestModel data)? validateOtp,
    TResult? Function(UpdatePasswordRequestModel data)? updatePassword,
  }) {
    return updatePassword?.call(data);
  }

  @override
  @optionalTypeArgs
  TResult maybeWhen<TResult extends Object?>({
    TResult Function(GetOtpRequestModel data)? getOtp,
    TResult Function(ValidateOtpRequestModel data)? validateOtp,
    TResult Function(UpdatePasswordRequestModel data)? updatePassword,
    required TResult orElse(),
  }) {
    if (updatePassword != null) {
      return updatePassword(data);
    }
    return orElse();
  }

  @override
  @optionalTypeArgs
  TResult map<TResult extends Object?>({
    required TResult Function(GetOtp value) getOtp,
    required TResult Function(ValidateOtp value) validateOtp,
    required TResult Function(UpdatePassword value) updatePassword,
  }) {
    return updatePassword(this);
  }

  @override
  @optionalTypeArgs
  TResult? mapOrNull<TResult extends Object?>({
    TResult? Function(GetOtp value)? getOtp,
    TResult? Function(ValidateOtp value)? validateOtp,
    TResult? Function(UpdatePassword value)? updatePassword,
  }) {
    return updatePassword?.call(this);
  }

  @override
  @optionalTypeArgs
  TResult maybeMap<TResult extends Object?>({
    TResult Function(GetOtp value)? getOtp,
    TResult Function(ValidateOtp value)? validateOtp,
    TResult Function(UpdatePassword value)? updatePassword,
    required TResult orElse(),
  }) {
    if (updatePassword != null) {
      return updatePassword(this);
    }
    return orElse();
  }
}

abstract class UpdatePassword implements AuthEvent {
  factory UpdatePassword(final UpdatePasswordRequestModel data) =
      _$UpdatePasswordImpl;

  @override
  UpdatePasswordRequestModel get data;
  @JsonKey(ignore: true)
  _$$UpdatePasswordImplCopyWith<_$UpdatePasswordImpl> get copyWith =>
      throw _privateConstructorUsedError;
}
