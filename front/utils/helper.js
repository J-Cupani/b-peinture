export const generateToken = (lng = 12) => {
  const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
  let token = "";
  for (let i = 0; i < lng; i++) {
    const randomIndex = Math.floor(Math.random() * charset.length);
    token += charset[randomIndex];
  }
  return token;
}

export const truncateString = (str, num) => {
  if (str.length <= num) {
    return str
  }
  return str.slice(0, num) + '...'
}

export const getInitials = (name) => {
  const names = name.split(' ')
  const initials = names.map(n => n[0]).join('')
  return initials.toUpperCase()
}

/**
 * Convertit un objet JavaScript en FormData, en gérant les objets imbriqués et les fichiers.
 *
 * @param {Object} obj - L'objet à convertir en FormData. Chaque propriété peut être une valeur simple, un objet, ou un fichier.
 * @param {FormData} [form=new FormData()] - Le FormData dans lequel ajouter les valeurs. Si non spécifié, un nouveau FormData est créé.
 * @param {string} [namespace=''] - Le namespace utilisé pour nommer les clés dans FormData. Utilisé pour les objets imbriqués.
 *
 * @returns {FormData} - Le FormData contenant toutes les données de l'objet.
 */
export function objectToFormData(obj, form = new FormData(), namespace = '') {
  // Parcourt chaque propriété de l'objet
  for (let property in obj) {
    // Vérifie si la propriété appartient bien à l'objet et n'est pas null
    if (!obj.hasOwnProperty(property) || obj[property] === null) {
      continue; // Ignore les propriétés non définies ou nulles
    }

    // Si le namespace est fourni (pour les objets imbriqués), on crée une clé formatée avec le namespace
    const formKey = namespace ? `${namespace}[${property}]` : property;

    // Vérifie si la propriété est un fichier (instance de File)
    if (obj[property] instanceof File) {
      // Si c'est un fichier, on l'ajoute directement au FormData avec sa clé
      form.append(formKey, obj[property]);
    }
    // Si la propriété est un objet (mais pas un fichier), on appelle la fonction récursivement
    else if (typeof obj[property] === 'object' && !(obj[property] instanceof File)) {
      objectToFormData(obj[property], form, formKey);  // Récursion pour gérer les objets imbriqués
    }
    // Si c'est une valeur simple (chaîne, nombre, etc.), on l'ajoute directement au FormData
    else {
      form.append(formKey, obj[property]);
    }
  }

  // Retourne l'objet FormData final contenant toutes les valeurs ajoutées
  return form;
}