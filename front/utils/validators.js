// 👉 Require Validator
export const requiredValidator = (value, label = '') => {
  const isValid = value !== null && value !== undefined && value !== false && String(value).trim().length > 0;

  if (!isValid) {
    return label ? `Le champ "${label}" est obligatoire` : 'Ce champ est obligatoire';
  }

  return true
}

// 👉 Email Validator
export const emailValidator = value => {
  if (isEmpty(value))
    return true
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

  if (Array.isArray(value))
    return value.every(val => re.test(String(val))) || 'Le champ "Email" doit être un e-mail valide'

  return re.test(String(value)) || 'Le champ "Email" doit être un e-mail valide'
}

// 👉 Mobile Validator
export const mobileValidator = value => {
  if (isEmpty(value))
    return true
  const re = /^\+(?:[0-9] ?){6,14}[0-9]$/
  if (Array.isArray(value))
    return value.every(val => re.test(String(val))) || 'Ce champ doit être un numéro de téléphone valide'

  return re.test(String(value)) || 'Ce champ doit être un numéro de téléphone valide'
}

// 👉 Password Validator
export const passwordValidator = (password) => {
  // Regex : Au moins une majuscule, une minuscule, un chiffre, un caractère spécial, et au moins 8 caractères
  const regExp = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%&*().]).{8,}$/
  const validPassword = regExp.test(password)

  return validPassword || 'Le mot de passe n\'est pas assez fort 💪'
}

// 👉 Confirm Password Validator
export const confirmedValidator = (value, target) => value === target || 'La confirmation ne correspond pas'

// 👉 Between Validator
export const betweenValidator = (value, min, max) => {
  const valueAsNumber = Number(value)

  return (Number(min) <= valueAsNumber && Number(max) >= valueAsNumber) || `Entrez un nombre entre ${min} et ${max}`
}

// 👉 Integer Validator
export const integerValidator = value => {
  if (isEmpty(value))
    return true
  if (Array.isArray(value))
    return value.every(val => /^-?[0-9]+$/.test(String(val))) || 'Ce champ doit être un entier'

  return /^-?[0-9]+$/.test(String(value)) || 'Ce champ doit être un entier'
}

// 👉 Regex Validator
export const regexValidator = (value, regex) => {
  if (isEmpty(value))
    return true
  let regeX = regex
  if (typeof regeX === 'string')
    regeX = new RegExp(regeX)
  if (Array.isArray(value))
    return value.every(val => regexValidator(val, regeX))

  return regeX.test(String(value)) || 'Le format du champ est invalide'
}

// 👉 Alpha Validator
export const alphaValidator = value => {
  if (isEmpty(value))
    return true

  return /^[A-Z]*$/i.test(String(value)) || 'Ce champ ne peut contenir que des caractères alphabétiques'
}

// 👉 URL Validator
export const urlValidator = value => {
  if (isEmpty(value))
    return true
  const re = /^(http[s]?:\/\/){0,1}(www\.){0,1}[a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,5}[\.]{0,1}/

  return re.test(String(value)) || 'L\'URL est invalide'
}

// 👉 Length Validator
export const lengthValidator = (value, length) => {
  if (isEmpty(value))
    return true

  return String(value).length === length || `Ce champ doit contenir exactement ${length} caractères`
}

export const maxValidator = (value, max) => {
  return parseInt(value) < parseInt(max) || `Maximum ${max}`
}

// 👉 Alpha-dash Validator
export const alphaDashValidator = value => {
  if (isEmpty(value))
    return true
  const valueAsString = String(value)

  return /^[0-9A-Z_-]*$/i.test(valueAsString) || 'Certains caractères ne sont pas valides'
}